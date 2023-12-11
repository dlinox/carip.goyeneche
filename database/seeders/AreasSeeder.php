<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'name' => 'Administración',
                'description' => 'Área de administración',
            ],
            [
                'name' => 'Logística',
                'description' => 'Área de operaciones',
            ],
            [
                'name' => 'Personal',
                'description' => 'Área de personal',
            ],
            [
                'name' => 'Planeamiento',
                'description' => 'Área de Planeamiento',
            ],
            [
                'name' => 'Epidemiología',
                'description' => 'Área de Epidemiología',
            ],
            [
                'name' => 'Gestion de Calidad',
                'description' => 'Área de Calidad',
            ],
            [
                'name' => 'Estadistica',
                'description' => 'Área de Estadistica',
            ],
        ];

        foreach ($areas as $area) {
            \App\Models\Area::create($area);
        }
    }
}
