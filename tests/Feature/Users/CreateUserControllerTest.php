<?php

use App\Repositories\Eloquent\Models\User;

beforeEach(function () {
    $this->url = route('users.store');
    $this->defaultUser = User::find(1);
});

describe('CreateUseControlelr', function () {
    it('Usuário não enviou nenhum dado para cadastro', function () {
        $token = $this->getCsrfToken();

        $response = $this
            ->actingAs($this->defaultUser, 'web')
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->post($this->url, [
                '_token' => $token,
            ]);

        $response->assertStatus(422);
    });
    it('Usuário enviou um email inválido', function () {
        $token = $this->getCsrfToken();

        $response = $this
            ->actingAs($this->defaultUser, 'web')
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->post($this->url, [
                '_token' => $token,
                'name' => 'Mauricio',
                'email' => 'email-invalido',
                'password' => 'senha123',
                'password_confirmation' => 'senha123'
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    });
    it('Usuário enviou a confirmação de senha diferente', function () {
        $token = $this->getCsrfToken();

        $response = $this
            ->actingAs($this->defaultUser, 'web')
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->post($this->url, [
                '_token' => $token,
                'name' => 'Mauricio',
                'email' => 'mauriciovictor@gmail.com',
                'password' => 'senha123',
                'password_confirmation' => 'senha1231212'
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
    });
    it('Usuário inseriu um email já vinculado a outro usuário', function () {
        $token = $this->getCsrfToken();

        $user = User::factory()->create();

        $response = $this
            ->actingAs($this->defaultUser, 'web')
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->post($this->url, [
                '_token' => $token,
                'name' => 'Mauricio',
                'email' => $user->email,
                'password' => 'senha123',
                'password_confirmation' => 'senha1231212'
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    });
    it('deve cadastrar um novo usuário', function () {
        $token = $this->getCsrfToken();

        $response = $this
            ->actingAs($this->defaultUser, 'web')
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->post($this->url, [
                '_token' => $token,
                'name' => 'Mauricio',
                'email' => 'mmauriciovictor17@gmail.com',
                'password' => 'senha123',
                'role_id' => 1,
                'password_confirmation' => 'senha123'
            ]);
        
        // status
        $response->assertRedirect(route('users.index'));

        // mensagem de sessão
        $response->assertSessionHas('success', 'Usuário criado com sucesso');

        // valida se realmente criou no banco
        $this->assertDatabaseHas('users', [
            'email' => 'mmauriciovictor17@gmail.com',
            'role_id' => 1
        ]);
    });
});

