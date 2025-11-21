<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        // Limpa TODAS as variáveis relacionadas ao ambiente
        putenv('APP_ENV');
        unset($_ENV['APP_ENV']);
        unset($_SERVER['APP_ENV']);

        // Define explicitamente o ambiente de teste
        putenv('APP_ENV=testing');
        $_ENV['APP_ENV'] = 'testing';
        $_SERVER['APP_ENV'] = 'testing';

        $app = require __DIR__ . '/../bootstrap/app.php';

        // Força o ambiente antes do bootstrap
        $app->detectEnvironment(function () {
            return 'testing';
        });

        $app->make(Kernel::class)->bootstrap();

        // Força todas as configurações necessárias
        $app['config']->set('app.env', 'testing');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('cache.default', 'array');
        $app['config']->set('queue.default', 'sync');
        $app['config']->set('mail.default', 'array');
        $app['config']->set('session.driver', 'array');

        return $app;
    }
}
