<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::where('email', 'vinicius@gmail.com')->first();

        $phoneNumber = rand(11, 99) . rand(90000, 99999) . rand(1000, 9999);

        $clients = [
            [
                'user_id' => $user->id,
                'name' => 'Artur Prata',
                'phone' => $phoneNumber++
            ],
            [
                'user_id' => $user->id,
                'name' => 'Lucas Shinozaki',
                'phone' => $phoneNumber++
            ],
            [
                'user_id' => $user->id,
                'name' => 'Leonardo Giazzi',
                'phone' => $phoneNumber++
            ],
            [
                'user_id' => $user->id,
                'name' => 'Matheus Ruan Teodoro',
                'phone' => $phoneNumber++
            ],
            [
                'user_id' => $user->id,
                'name' => 'Carlos Parminondi',
                'phone' => $phoneNumber++
            ],
            [
                'user_id' => $user->id,
                'name' => 'Giovana Kuwakino',
                'phone' => $phoneNumber++
            ]
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
