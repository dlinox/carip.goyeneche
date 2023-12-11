<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // WithoutModelEvents::class;
        $this->call([
            AreasSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            ModelHasPermissionSeeder::class,
            AuthoritySeeder::class,
            SpecialtySeeder::class,
        ]);
    }
}
