<?php

namespace Database\Seeders;

use App\Models\Authority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthoritySeeder extends Seeder
{
 

    
    public function run(): void
    {
        $positions = [
            [
                "position" => 'Dirección General',
               
            ],
            [
                "position" => 'Sub Dirección',

            ],
            [
                "position" => 'Dirección Ejecutiva de Administración',

            ],
        ];

        foreach ($positions as $position) {
            Authority::create([
                "position" => $position['position'],
            ]);
        }
    }
}
