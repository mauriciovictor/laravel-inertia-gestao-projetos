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
                'X-Requested-With' => 'XMLHttpRequest',
            ])
            ->post($this->url, [
                '_token' => $token,
            ]);

        $response->assertStatus(422);
    });
});

