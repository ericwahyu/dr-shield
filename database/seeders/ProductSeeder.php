<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $datas = [
            [
                'name'            => 'Single Wall RF 960',
                'profile'         => 'doff',
                'length'          => 1320,
                'width'           => 960,
                'effective_width' => null,
                'price'           => 150000,
                'is_roof'         => 1,
            ],
            [
                'name'            => 'Twinwall RF 1065',
                'profile'         => 'doff',
                'length'          => null,
                'width'           => null,
                'effective_width' => 1065,
                'price'           => 225000,
                'is_roof'         => 0,
            ],
            [
                'name'            => 'Twinwall RF 1065',
                'profile'         => 'translucent',
                'length'          => null,
                'width'           => null,
                'effective_width' => 1065,
                'price'           => 300000,
                'is_roof'         => 0,
            ],
            [
                'name'            => 'Single Wall RF 1050',
                'profile'         => 'doff',
                'length'          => null,
                'width'           => null,
                'effective_width' => 1050,
                'price'           => 148000,
                'is_roof'         => 0,
            ],
            [
                'name'            => 'Single Wall RF 1050',
                'profile'         => 'translucent',
                'length'          => null,
                'width'           => null,
                'effective_width' => 1050,
                'price'           => 188000,
                'is_roof'         => 0,
            ],
            [
                'name'            => 'TwinWall OD 760',
                'profile'         => 'doff',
                'length'          => null,
                'width'           => null,
                'effective_width' => 760,
                'price'           => 140000,
                'is_roof'         => 0,
            ],
            [
                'name'            => 'TwinWall OD 860',
                'profile'         => 'doff',
                'length'          => null,
                'width'           => null,
                'effective_width' => 860,
                'price'           => 160000,
                'is_roof'         => 0,
            ],
            [
                'name'            => 'Single Wall OD 1000',
                'profile'         => 'doff',
                'length'          => null,
                'width'           => null,
                'effective_width' => 1000,
                'price'           => 80000,
                'is_roof'         => 0,
            ],
            [
                'name'            => 'Single Wall OD 750',
                'profile'         => 'doff',
                'length'          => null,
                'width'           => null,
                'effective_width' => 750,
                'price'           => 60000,
                'is_roof'         => 0,
            ],
            [
                'name'            => 'Single Wall OD 880',
                'profile'         => 'doff',
                'length'          => null,
                'width'           => null,
                'effective_width' => 880,
                'price'           => 70000,
                'is_roof'         => 0,
            ],
        ];

        foreach ($datas as $value) {

            Product::create([
                'name'            => $value['name'],
                'profile'         => $value['profile'],
                'length'          => $value['length'],
                'width'           => $value['width'],
                'effective_width' => $value['effective_width'],
                'price'           => $value['price'],
                'is_roof'         => $value['is_roof'],
            ]);

        }
    }
}
