<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $services = [
            [
                'client_id' => 1,
                'device' => 'Celular',
                'brand' => 'Apple',
                'model' => 'Iphone 14',
                'description' => 'Display com defeito',
                'price' => 192.40,
                'paid' => true
            ],
            [
                'client_id' => 2,
                'device' => 'Celular',
                'brand' => 'Samsung',
                'model' => 'S24',
                'description' => 'Troca de bateria',
                'price' => 89.90,
                'paid' => false
            ],
            [
                'client_id' => 3,
                'device' => 'TV',
                'brand' => 'Samsung',
                'model' => 'Smart Tv 50 polegadas QLED 4K',
                'description' => 'Led queimado',
                'price' => 126.10,
                'paid' => false
            ],
            [
                'client_id' => 1,
                'device' => 'Controle',
                'brand' => '8BitDo',
                'description' => 'Botão R3 com defeito',
                'price' => 41.70,
                'paid' => false
            ],
            [
                'client_id' => 2,
                'device' => 'Microondas',
                'brand' => 'Philco',
                'description' => 'Não liga',
                'price' => 97.10,
                'paid' => false
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

    }
}
