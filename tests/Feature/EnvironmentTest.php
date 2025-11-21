<?php

use Tests\TestCase;

it('verifica se o ambiente de teste está funcionando', function () {
    expect(app()->environment())->toBe('testing');
    expect(config('database.default'))->toBe('sqlite');
    expect(config('database.connections.sqlite.database'))->toBe(':memory:');
});
