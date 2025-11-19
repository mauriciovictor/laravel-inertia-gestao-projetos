<?php

use App\DTOs\UserData;
use App\ValueObjects\Password;
use App\Repositories\Eloquent\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Facades\Hash;

// Setup executado antes de cada teste (arrange comum para todos os testes)
// - Mockamos o Hash para não depender da implementação real (gera uma hash simulada)
// - Mockamos o model User para injetar no repositório e não tocar o banco
// - Instanciamos o UserRepository com o mock do model
beforeEach(function () {
    // Substitui a chamada real para Hash::make por um retorno controlado
    Hash::shouldReceive('make')->andReturn('hash-simulada');

    // Cria um mock do model User (não persiste nada no DB)
    $this->userModel = Mockery::mock(User::class)->makePartial();

    // mock do query builder
    $this->query = Mockery::mock(Builder::class);

    // newQuery()
    $this->userModel
        ->shouldReceive('newQuery')
        ->andReturn($this->query);

    // Instancia o repositório usando o mock (injeção de dependência)
    $this->repository = new UserRepository($this->userModel);
});

// Cleanup executado após cada teste — fecha os mocks do Mockery
afterEach(function () {
    Mockery::close();
});

// Teste: criação de usuário
// Objetivo: garantir que o método create do repositório envia os dados corretos
// Arranjo: monta um UserData com nome, email, role_id e password
// Expectativa: o model receberá create(...) com os campos corretos e retornará um User
// Verificação: o resultado é uma instância de User e o nome corresponde
test('cria um usuário com os dados corretos', function () {
    $userData = new UserData(
        name: 'João Silva',
        email: 'joao@example.com',
        role_id: 1,
        password: new Password('senha123')
    );

    // Usuário esperado que será retornado pelo mock do model
    $expectedUser = new User();
    $expectedUser->id = 1;
    $expectedUser->name = 'João Silva';

    // Configura o comportamento esperado do mock do model:
    // - deve receber create uma vez
    // - o callback (Mockery::on) verifica que os dados enviados estão corretos
    // - retorna o usuário esperado
    $this->userModel
        ->shouldReceive('create')
        ->once()
        ->with(Mockery::on(function ($data) {
            // Aqui checamos cada campo esperado (name, email, role_id) e
            // garantimos que a senha foi convertida para string (hash)
            return $data['name'] === 'João Silva'
                && $data['email'] === 'joao@example.com'
                && $data['role_id'] === 1
                && is_string($data['password']);
        }))
        ->andReturn($expectedUser);

    // Ação: chama o create do repositório com o DTO
    $result = $this->repository->create($userData);

    // Asserção: valida o tipo e os valores retornados (assert)
    expect($result)->toBeInstanceOf(User::class)
        ->and($result->name)->toBe('João Silva');
});

// Teste: atualização sem alterar senha
// Objetivo: verificar que quando password é null, o update não inclui o campo password
// Arranjo: cria um UserData sem senha; mocka o model encontrado e seu método update
// Expectativa: update é chamado com array contendo apenas name, email e role_id
// Observação: find é chamado no model (duas vezes no código do repositório)
test('atualiza um usuário sem alterar a senha', function () {
    $userData = new UserData(
        name: 'João Atualizado',
        email: 'joao@example.com',
        role_id: 1,
        password: null
    );

    // Mock do objeto User retornado por find; aqui só nos preocupamos com update()
    $user = Mockery::mock(User::class);
    $user->shouldReceive('update')
        ->once()
        ->with([
            'name' => 'João Atualizado',
            'email' => 'joao@example.com',
            'role_id' => 1,
        ]);

    // Espera que o model->find(1) seja chamado e retorne o mock $user
    // observe o ->twice() porque o repositório pode chamar find mais de uma vez
    $this->userModel
        ->shouldReceive('find')
        ->with(1)
        ->twice()
        ->andReturn($user);

    // Ação: executa update no repositório
    $result = $this->repository->update(1, $userData);

    // Asserção: espera um objeto User (o próprio mock retornado)
    expect($result)->toBeInstanceOf(User::class);
});

// Teste: remoção de usuário
// Objetivo: garantir que o método delete do repositório invoque delete() no model encontrado
// Arranjo: mock do User com delete retornando true
// Expectativa: o método delete do repositório devolve true
test('deleta um usuário', function () {
    $user = Mockery::mock(User::class);
    $user->shouldReceive('delete')
        ->once()
        ->andReturn(true);

    // Quando model->find(1) for chamado, retorna o mock $user
    $this->userModel
        ->shouldReceive('find')
        ->with(1)
        ->once()
        ->andReturn($user);

    // Ação: chamada ao repositório
    $result = $this->repository->delete(1);

    // Asserção: resultado verdadeiro indicando sucesso da exclusão
    expect($result)->toBeTrue();
});

// Teste: aplicação de filtros na query
// Objetivo: verificar se applyFilters traduz um filtro 'contains' para where(..., 'like', '%value%')
// Arranjo: mock do Builder e valores de filtros
// Expectativa: o método where é chamado com os parâmetros corretos
test('aplica filtros corretamente na query', function () {
    $query = Mockery::mock(Builder::class);
    $fieldsFilters = ['name', 'email'];
    $filterValues = [
        'name' => ['value' => 'João', 'match' => 'contains']
    ];

    // Espera que o query->where seja invocado com o padrão like e %João%
    $query->shouldReceive('where')
        ->once()
        ->with('name', 'like', '%João%')
        ->andReturnSelf();

    // Ação: chama applyFilters do repositório
    $this->repository->applyFilters($query, $fieldsFilters, $filterValues);
});

// Teste: ordenação padrão
// Objetivo: quando não há campo/order especificados, aplicar uma ordenação padrão (ex: name desc)
// Arranjo: mock do Builder, fieldSortValues vazio
// Expectativa: orderBy('name', 'desc') é chamado
test('aplica ordenação padrão quando não há valores de ordenação', function () {
    $query = Mockery::mock(Builder::class);
    $fieldSortValues = ['field' => null, 'order' => null];

    $query->shouldReceive('orderBy')
        ->once()
        ->with('name', 'desc')
        ->andReturnSelf();

    $this->repository->applyOrder($query, $fieldSortValues);
});

// Teste: ordenação customizada
// Objetivo: quando existe field/order, repassar ao query->orderBy corretamente
// Arranjo: mock do Builder com field=email, order=asc
// Expectativa: orderBy('email', 'asc') é chamado
test('aplica ordenação customizada', function () {
    $query = Mockery::mock(Builder::class);
    $fieldSortValues = ['field' => 'email', 'order' => 'asc'];

    $query->shouldReceive('orderBy')
        ->once()
        ->with('email', 'asc')
        ->andReturnSelf();

    $this->repository->applyOrder($query, $fieldSortValues);
});

// Teste: busca global (search)
// Objetivo: garantir que applySearch constrói uma subquery que procura em name e email usando like
// Arranjo: mock do Builder e implementação do callback que o repositório usa para montar a busca
// Expectativa: a callback executa where(name like %teste%) e orWhere(email like %teste%)
test('aplica busca corretamente', function () {
    $query = Mockery::mock(Builder::class);
    $search = 'teste';

    // Quando for chamado where com callback, usamos andReturnUsing para executar o callback
    $query->shouldReceive('where')
        ->once()
        ->andReturnUsing(function ($callback) use ($query) {
            // Mock interno que representa a subquery passada ao callback
            $innerQuery = Mockery::mock(Builder::class);
            $innerQuery->shouldReceive('where')
                ->with('name', 'like', '%teste%')
                ->andReturnSelf();
            $innerQuery->shouldReceive('orWhere')
                ->with('email', 'like', '%teste%')
                ->andReturnSelf();

            // Executa o callback fornecendo o innerQuery - assim simulamos o comportamento real
            $callback($innerQuery);
            return $query;
        });

    // Ação: aplica a busca no repositório
    $this->repository->applySearch($query, $search);
});

// Teste: contar usuários por role
// Objetivo: verificar se findCountByRole chama where('role_id', X)->count() e retorna o número correto
// Arranjo: mock do model para encadear where()->count() e retornar 5
// Expectativa: o repositório devolve 5
test('conta usuários por role', function () {
    $this->userModel
        ->shouldReceive('where') //metodoo chamado
        ->once() //quantidade de vezes que o metodo deve ser chamado
        ->with('role_id', 1) //parametro passado
        ->andReturnSelf() //retorna o objeto no caso: $this->userModel
        ->shouldReceive('count') //metodo chamado
        ->once()// quantidade de vezes que o metodo deve ser chamado
        ->andReturn(5) //retorna o valor
    ;

    // Ação: chama o método do repositório
    $result = $this->repository->findCountByRole(1);

    // Asserção: resultado é 5
    expect($result)->toBe(5);
});

it('paginação com filtros', function () {
    // mock paginator
    $paginatorMock = Mockery::mock(AbstractPaginator::class);

    $paginatorMock->shouldReceive('appends')
        ->once()
        ->with(['foo' => 'bar'])
        ->andReturnSelf();

    // with()
    $this->query->shouldReceive('with')
        ->once()
        ->with('role')
        ->andReturnSelf();

    // applyFilters -> where()
    $this->query->shouldReceive('where')
        ->once()
        ->with('name', '=', 'Luffy')
        ->andReturnSelf();

    // applySearch -> where(closure)
    $this->query->shouldReceive('where')
        ->once()
        ->with(Mockery::on(fn($c) => is_callable($c)))
        ->andReturnSelf();

    // applyOrder → orderBy()
    $this->query->shouldReceive('orderBy')
        ->once()
        ->with('name', 'asc')
        ->andReturnSelf();

    // paginate()
    $this->query->shouldReceive('paginate')
        ->once()
        ->with(5, ['*'], 'page', 1)
        ->andReturn($paginatorMock);

    // execução
    $result = $this->repository->allPaged(
        fieldsFilters: ['name'],
        filterValues: [
            'name' => [
                'match' => 'equals',
                'value' => 'Luffy',
            ],
        ],
        fielSortValues: [
            'field' => 'name',
            'order' => 'asc',
        ],
        appends: ['foo' => 'bar'],
        search: '',
        page: 1,
        per_page: 5
    );
   
    expect($result)->toBe($paginatorMock);
});
