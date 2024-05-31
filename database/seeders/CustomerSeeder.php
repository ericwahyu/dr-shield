<?php

namespace Database\Seeders;

use App\Models\Customer;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    // public function __construct()
    // {
    //     $this->table      = 'customers';
    //     $this->filename   = base_path() . '/database/seeders/csvs/Data customer utf-8.csv';
    //     // $this->timestamps = true;
    // }

    // public function run()
    // {
    //     DB::disableQueryLog();
    //     DB::table($this->table)->truncate();
    //     parent::run();
    // }
    public function run()
    {
        Customer::truncate();
        $csvFile = fopen(base_path("database/seeders/csvs/Data customer utf-8.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 0, ";")) !== FALSE) {
            if (!$firstline) {
                // dd($data['1']);
                Customer::create([
                    "date"        => $data['0'],
                    "category"    => $data['1'],
                    "name"        => $data['2'],
                    "phone"       => '0'.$data['3'],
                    "needs"       => $data['4'],
                    "address"     => $data['5'],
                    "store"       => $data['6'],
                    "description" => $data['7'],
                    "response"    => $data['8'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
