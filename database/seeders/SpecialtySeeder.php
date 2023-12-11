<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $especialidades = [
            [
                'name' => 'Cardiología',
                'description' => 'Especialización en el corazón y los vasos sanguíneos.',
            ],
            [
                'name' => 'Ortopedia',
                'description' => 'Tratamiento de deformidades o discapacidades funcionales del sistema esquelético.',
            ],
            [
                'name' => 'Dermatología',
                'description' => 'Enfermedades de la piel, cabello y uñas.',
            ],
            [
                'name' => 'Neurología',
                'description' => 'Estudio del sistema nervioso.',
            ],
            [
                'name' => 'Ginecología',
                'description' => 'Salud reproductiva femenina.',
            ],
            // Agrega más especialidades según sea necesario
        ];

        foreach ($especialidades as $especialidad) {
            DB::table('specialties')->insert($especialidad);
        }
    }
}
