<?php

use App\DTOs\ProjectData;
use App\Enums\ProjectStatusEnum;
use App\Repositories\Eloquent\Models\Project;
use App\Repositories\Eloquent\ProjectRepository;

beforeEach(function () {
    $this->projectModel = Mockery::mock(Project::class);
    $this->repository = new ProjectRepository($this->projectModel);
});

afterEach(function () {
    Mockery::close();
});


describe('ProjectRepository', function () {
    it('cria um projeto com os dados corretos', function () {
        $defaultStatus = ProjectStatusEnum::from('active');

        $projectData = new ProjectData(
            title: 'Novo Projeto',
            description: 'Descricação do projeto',
            status: $defaultStatus
        );

        $expected = $projectData->toArray();
        $expected['id'] = '123';

        $this
            ->projectModel
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($arg) use ($projectData) {
                return $arg['title'] === $projectData->title
                    && $arg['description'] === $projectData->description
                    && $arg['status'] === $projectData->status->value;
            }))
            ->andReturn($expected);

        $result = $this->repository->create($projectData);

        expect($result)->toHaveAttribute('id');
    });

    it('atualiza um projeto corretamente', function () {
        $id = '123';

        $projectData = new ProjectData(
            title: 'Projeto Atualizado',
            description: 'Descrição atualizada',
            status: ProjectStatusEnum::from('active')
        );

        $expectedInput = [
            'title' => $projectData->title,
            'description' => $projectData->description,
            'status' => 'active',
        ];

        // Mock do objeto retornado por find()
        $foundModelMock = Mockery::mock();

        // 1ª chamada ao find() → deve retornar um model para chamar update()
        $this->projectModel
            ->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn($foundModelMock);

        // Mock da chamada ao update()
        $foundModelMock
            ->shouldReceive('update')
            ->once()
            ->with($expectedInput)
            ->andReturn(true);

        // 2ª chamada ao find() → retorna o model atualizado
        $updatedResult = (object)[
            'id' => $id,
            ...$expectedInput
        ];

        $this->projectModel
            ->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn($updatedResult);

        $result = $this->repository->update($id, $projectData);

        expect($result)->toBeObject()
            ->and($result->id)->toBe($id)
            ->and($result->title)->toBe('Projeto Atualizado')
            ->and($result->description)->toBe('Descrição atualizada');
    });

    it('encontra um projeto pelo id', function () {

        $id = '123';
        $expected = (object)['id' => $id];

        $this
            ->projectModel
            ->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn($expected);

        $result = $this->repository->findById($id);

        expect($result)->toBeObject()
            ->and($result->id)->toBe($id);
    });

    it('não encontra o projeto pelo id', function () {

        $id = '123';

        $this
            ->projectModel
            ->shouldReceive('find')
            ->once()
            ->with('123')
            ->andReturn(null);

        $result = $this->repository->findById($id);

        expect($result)->toBeNull();
    });

    it('pagina os projetos corretamente', function () {
        $page = 2;
        $perPage = 10;

        $this->projectModel
            ->shouldReceive('paginate')
            ->once()
            ->withAnyArgs()
            ->andReturn(Mockery::mock(\Illuminate\Pagination\AbstractPaginator::class));

        $result = $this->repository->allPaged($page, $perPage);
        expect($result)->toBeInstanceOf(\Illuminate\Pagination\AbstractPaginator::class);

    });

    it('deleta um projeto corretamente', function () {
        $id = '123';

        $this->projectModel
            ->shouldReceive('destroy')
            ->once()
            ->with($id)
            ->andReturn(true);

        $result = $this->repository->delete($id);
        expect($result)->toBeTrue();
    });
});
