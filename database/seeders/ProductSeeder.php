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
            // RF Premium Series
            [
                'category'         => 'RF Premium Series',
                'name'             => 'Twinwall RF 1065 mm - 15 Yrs',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 1065,
                'calculated'       => 'upvc',
                'price'            => 225000,
                'price_unit'       => 'M'
            ],
            [
                'category'         => 'RF Premium Series',
                'name'             => 'Twinwall RF 1065 mm - 15 Yrs',
                'profile'          => 'translucent',
                'effective_length' => null,
                'effective_width'  => 1065,
                'calculated'       => 'upvc',
                'price'            => 300000,
                'price_unit'       => 'M'
            ],
            [
                'category'         => 'RF Premium Series',
                'name'             => 'Single Wall RF 1050 mm - 10 Yrs',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 1050,
                'calculated'       => 'upvc',
                'price'            => 148000,
                'price_unit'       => 'M'
            ],
            [
                'category'         => 'RF Premium Series',
                'name'             => 'Single Wall RF 1050 mm - 10 Yrs',
                'profile'          => 'translucent',
                'effective_length' => null,
                'effective_width'  => 1050,
                'calculated'       => 'upvc',
                'price'            => 188000,
                'price_unit'       => 'M'
            ],
            [
                'category'         => 'RF Premium Series',
                'name'             => 'Single Wall RF 960 Tile ASA',
                'profile'          => 'doff',
                'effective_length' => 1320,
                'effective_width'  => 960,
                'calculated'       => 'proof',
                'price'            => 150000,
                'price_unit'       => 'Lembar'
            ],
            // OD Series
            [
                'category'         => 'OD Series',
                'name'             => 'Twinwall OD 760 mm - 10 Yrs (max 6M)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 760,
                'calculated'       => 'upvc',
                'price'            => 140000,
                'price_unit'       => 'M'
            ],
            [
                'category'         => 'OD Series',
                'name'             => 'Twinwall OD 860 mm - 10 Yrs (max 6M)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 860,
                'calculated'       => 'upvc',
                'price'            => 160000,
                'price_unit'       => 'M'
            ],
            [
                'category'         => 'OD Series',
                'name'             => 'Single Wall OD 1000 mm Trimdeck',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 1000,
                'calculated'       => 'upvc',
                'price'            => 80000,
                'price_unit'       => 'M'
            ],
            [
                'category'         => 'OD Series',
                'name'             => 'Single Wall OD 750 mm Trimdeck',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 750,
                'calculated'       => 'upvc',
                'price'            => 60000,
                'price_unit'       => 'M'
            ],
            [
                'category'         => 'OD Series',
                'name'             => 'Single Wall OD 880 Greca',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 880,
                'calculated'       => 'upvc',
                'price'            => 70000,
                'price_unit'       => 'M'
            ],
            //aksesoris
            [
                'category'         => 'Aksesoris',
                'name'             => 'Top Ridge - TW RF 1065 (912mm) - tipe bulat',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 912,
                'calculated'       => 'accessories',
                'price'            => 145000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Top Ridge - TW OD 860 mm - tipe segitiga',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 860,
                'calculated'       => 'accessories',
                'price'            => 145000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Top Ridge - TW OD 760 mm - tipe segitiga',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 760,
                'calculated'       => 'accessories',
                'price'            => 130000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Three Way Ridge - TW OD 760 mm / TW OD 830 mm / TW OD 860 mm',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => null,
                'calculated'       => 'pieces',
                'price'            => 130000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Side Ridge - TW OD 760 mm / TW OD 830 mm / TW OD 860 mm',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 1000,
                'calculated'       => 'accessories',
                'price'            => 130000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Top Ridge - SW RF 1050 mm - tipe segitiga',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 1050,
                'calculated'       => 'accessories',
                'price'            => 100000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Top Ridge - SW OD 750 mm Trimdeck - tipe segitiga',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 750,
                'calculated'       => 'accessories',
                'price'            => 70000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Three Way Ridge - SW OD 750 mm Trimdeck - tipe segitiga',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => null,
                'calculated'       => 'pieces',
                'price'            => 70000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Top Ridge - SW OD 1000 mm Trimdeck - tipe segitiga',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 1000,
                'calculated'       => 'accessories',
                'price'            => 85000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Three Way Ridge - SW OD 1000 mm Trimdeck - tipe segitiga',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => null,
                'calculated'       => 'pieces',
                'price'            => 85000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Side Ridge - SW OD 750 mm Trimdeck / SW OD 1000 Trimdeck',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 1000,
                'calculated'       => 'accessories',
                'price'            => 130000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Top Ridge - SW RF 960 Tile ASA (Genteng)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 960,
                'calculated'       => 'accessories',
                'price'            => 150000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Side Ridge - SW RF 960 Tile ASA (Genteng)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 940,
                'calculated'       => 'accessories',
                'price'            => 150000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Three Way Ridge - SW RF 960 mm Tile ASA (Genteng)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => null,
                'calculated'       => 'pieces',
                'price'            => 105000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Left Ridge - SW RF 960 mm Tile ASA (Genteng)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 1120,
                'calculated'       => 'accessories',
                'price'            => 105000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Right Ridge - SW RF 960 mm Tile ASA (Genteng)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 1120,
                'calculated'       => 'accessories',
                'price'            => 105000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Weather Board - SW RF 960 mm Tile ASA (Genteng)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => 960,
                'calculated'       => 'accessories',
                'price'            => 105000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'End Ridge / End Cap - SW RF 960 mm Tile ASA (Genteng)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => null,
                'calculated'       => 'pieces',
                'price'            => 73000,
                'price_unit'       => 'Lembar'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Roof Seal Set - TW 7,5 cm (per 40 pcs)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => null,
                'calculated'       => 'pieces',
                'price'            => 90000,
                'price_unit'       => '40 pcs'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Roof Seal Set - TW 7 cm (per 40 pcs)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => null,
                'calculated'       => 'pieces',
                'price'            => 88000,
                'price_unit'       => '40 pcs'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Roof Seal Set - TW 6 cm (per 40 pcs)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => null,
                'calculated'       => 'pieces',
                'price'            => 85000,
                'price_unit'       => '40 pcs'
            ],
            [
                'category'         => 'Aksesoris',
                'name'             => 'Weather Seal (per 40 pcs)',
                'profile'          => 'doff',
                'effective_length' => null,
                'effective_width'  => null,
                'calculated'       => 'pieces',
                'price'            => 37000,
                'price_unit'       => '40 pcs'
            ],
        ];

        foreach ($datas as $value) {

            Product::create([
                'category'         => $value['category'],
                'name'             => $value['name'],
                'profile'          => $value['profile'],
                'effective_length' => $value['effective_length'],
                'effective_width'  => $value['effective_width'],
                'calculated'       => $value['calculated'],
                'price'            => $value['price'],
                'price_unit'       => $value['price_unit'],
            ]);
        }
    }
}
