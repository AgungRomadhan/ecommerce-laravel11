<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Distributor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456789'),
            'point' => 10000,
        ]);

        Admin::create([
            'name' => 'admin1',
            'username' => 'Admin',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
        Distributor::create([
            'nama_distributor' => 'PT.Daun Emas',
            'kota' => 'Pekanbaru',
            'provinsi' => 'Riau',
            'kontak' => ('081344332211'),
            'email' => 'daunemas@gmail.com',
        ]);
        Distributor::create([
            'nama_distributor' => 'PT.Telur Emas',
            'kota' => 'Bengkalis',
            'provinsi' => 'Riau',
            'kontak' => ('082244332211'),
            'email' => 'teluremas@gmail.com',
        ]);
    }
    }
