<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\TestDatabaseSeeder;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Opção 1: Usando Artisan (recomendado)
        Artisan::call('db:seed', [
            '--class' => TestDatabaseSeeder::class
        ]);

        // Opção 2: Instanciando diretamente (alternativa)
        // (new UserTestSeeder)->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Se necessário, adicione lógica de rollback aqui
    }
};
