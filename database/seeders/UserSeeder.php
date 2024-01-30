<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $users = [
            [
                'name' => 'Admin',
                'paternal_surname' => 'Admin',
                'maternal_surname' => 'Admin',
                'document_number' => '12345678',
                'phone_number' => '123456789',
                'username' => 'admin@goyeneche.pe',
                'role' => 'Administrador',
                'area_id' => 1,
                'email' => 'admin@goyeneche.pe',
                'password' => 'password',
            ],
            [
                'name' => 'Operador',
                'paternal_surname' => 'Operador',
                'maternal_surname' => 'Operador',
                'phone_number' => '987654321',
                'document_number' => '98765432',
                'username' => 'operador@goyeneche.pe',
                'role' => 'Operador',
                'area_id' => 1,
                'email' => 'operador@goyeneche.pe',
                'password' => 'password',
            ],
        ];


        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
