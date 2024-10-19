<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Vinicius Kuwakino',
            'email' => 'vinicius@gmail.com',
            'password' => Hash::make('123mudar')
        ]);

        $this->call(ClientsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
    }
}
