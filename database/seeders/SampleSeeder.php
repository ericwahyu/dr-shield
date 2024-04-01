<?php

namespace Database\Seeders;

use App\Models\Sample;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $datas = [
            [
                'name'    => 'Top Ridge - TW RF 1065 (912mm) - tipe bulat',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge - TW RF 1065 (912mm) - tipe bulat',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge - TW RF 1065 (912mm) - tipe bulat',
                'profile' => 'doff',
                'color'   => 'biru pekat',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge - TW OD 860 mm - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge - TW OD 860 mm - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge - TW OD 760 mm - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge - TW OD 760 mm - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Three Way Ridge / Side Ridge - TW OD 760 mm / TW OD 830 mm / TW OD 860 mm',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Three Way Ridge / Side Ridge - TW OD 760 mm / TW OD 830 mm / TW OD 860 mm',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge - SW RF 1050 mm - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge - SW RF 1050 mm - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge - SW RF 1050 mm - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'biru pekat',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge / Three Way Ridge - SW OD 750 mm Trimdeck - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge / Three Way Ridge - SW OD 750 mm Trimdeck - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge / Three Way Ridge - SW OD 1000 mm Trimdeck - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge / Three Way Ridge - SW OD 1000 mm Trimdeck - tipe segitiga',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Side Ridge - SW OD 750 mm Trimdeck / SW OD 1000 Trimdeck',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Side Ridge - SW OD 750 mm Trimdeck / SW OD 1000 Trimdeck',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge / Side Ridge - SW RF 960 Tile ASA (Genteng)',
                'profile' => 'doff',
                'color'   => 'black sakura',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Top Ridge / Side Ridge - SW RF 960 Tile ASA (Genteng)',
                'profile' => 'doff',
                'color'   => 'ruby maroon',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Three Way Ridge / Left Ridge / Right Ridge / Weather Board - SW RF 960 mm Tile ASA (Genteng)',
                'profile' => 'doff',
                'color'   => 'black sakura',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Three Way Ridge / Left Ridge / Right Ridge / Weather Board - SW RF 960 mm Tile ASA (Genteng)',
                'profile' => 'doff',
                'color'   => 'ruby maroon',
                'stock'   => 2000,
            ],
            [
                'name'    => 'End Ridge / End Cap - SW RF 960 mm Tile ASA (Genteng)',
                'profile' => 'doff',
                'color'   => 'black sakura',
                'stock'   => 2000,
            ],
            [
                'name'    => 'End Ridge / End Cap - SW RF 960 mm Tile ASA (Genteng)',
                'profile' => 'doff',
                'color'   => 'ruby maroon',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Roof Seal Set - TW 7,5 cm',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Roof Seal Set - TW 7,5 cm',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Roof Seal Set - SW 7 cm',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Roof Seal Set - SW 7 cm',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Roof Seal Set - SW 6 cm',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Roof Seal Set - SW 6 cm',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Roof Seal Set - SW 6 cm',
                'profile' => 'doff',
                'color'   => 'black sakura',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Roof Seal Set - SW 6 cm',
                'profile' => 'doff',
                'color'   => 'ruby maroon',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Weather Seal',
                'profile' => 'doff',
                'color'   => 'putih',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Weather Seal',
                'profile' => 'doff',
                'color'   => 'biru',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Weather Seal',
                'profile' => 'doff',
                'color'   => 'black sakura',
                'stock'   => 2000,
            ],
            [
                'name'    => 'Weather Seal',
                'profile' => 'doff',
                'color'   => 'ruby maroon',
                'stock'   => 2000,
            ],
        ];

        foreach ($datas as $value) {
            # code...
            Sample::create([
                'name'    => $value['name'],
                'profile' => $value['profile'],
                'color'   => $value['color'],
                'stock'   => $value['stock'],
            ]);
        }
    }
}
