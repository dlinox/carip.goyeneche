<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $permissions = [

            [
                'name' => 'a.users',
                'menu' => 'Gestion de Usuarios',
            ],
            [
                'name' => 'a.institutional',
                'menu' => 'Hospital',
            ],
            [
                'name' => 'a.workers',
                'menu' => 'Getion del personal',
            ],
            [
                'name' => 'a.sliders',
                'menu' => 'Slider',
            ],
            [
                'name' => 'a.final-services',
                'menu' => 'Servicios finales',
            ],
            [
                'name' => 'a.intermediate-services',
                'menu' => 'Servicios intermedios',
            ],
            [
                'name' => 'a.offices',
                'menu' => 'Oficinas',
            ],
            [
                'name' => 'a.service-portfolios',
                'menu' => 'Cartera de servicios',
            ],
            [
                'name' => 'a.guidance-documents',
                'menu' => 'Documentos guiás',
            ],
            [
                'name' => 'a.announcements',
                'menu' => 'Convocatorias',
            ],
            [
                'name' => 'a.purchase-and-service',
                'menu' => 'Compra y servicio',
            ],
            [
                'name' => 'a.news',
                'menu' => 'Getion de noticias',
            ],
            [
                'name' => 'a.publications',
                'menu' => 'Getion de publicaciones',
            ],
            [
                'name' => 'a.events',
                'menu' => 'Gestion de campañas y eventos',
            ],
            [
                'name' => 'a.supporting-services',
                'menu' => 'Servicios de apoyo',
            ],
            [
                'name' => 'a.specialties',
                'menu' => 'Especialidades',
            ],
            [
                'name' => 'a.areas',
                'menu' => 'Areas',
            ],
        ];

        $administrador = User::where('role', 'Administrador')->first();

        foreach ($permissions as $permission) {
            $administrador->givePermissionTo($permission['name']);
        }
    }
}
