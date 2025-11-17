<?php

use App\Repositories\Eloquent\UserRepository;
use App\UseCases\Users\DeleteUserUseCase;

beforeEach(function () {
    $this->userRepository = Mockery::mock(UserRepository::class)->makePartial();
    $this->useCase = new DeleteUserUSeCase($this->userRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('UserUseCases', function () {
    it('Deletar usuário', function () {
        $userId = 1;

        $this->userRepository
            ->shouldReceive('delete')
            ->once()
            ->with($userId)
            ->andReturn(true);

        $result = $this->useCase->execute($userId);

        expect($result)->toBeTrue();
    });
});
