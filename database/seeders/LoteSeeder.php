<?php

namespace Database\Seeders;

use App\Models\Lote;
use Illuminate\Database\Seeder;

class LoteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /** @var array<int, string> $codigos */
        $codigos = require database_path('seeders/data/lotes_nueva_jerusalem.php');

        $payload = array_map(static fn (string $codigo): array => [
            'codigo' => $codigo,
            'estado' => Lote::ESTADO_DISPONIBLE,
            'observaciones' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ], $codigos);

        Lote::upsert($payload, ['codigo'], ['updated_at']);
    }
}
