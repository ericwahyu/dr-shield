<?php

namespace Database\Seeders;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerRealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $csvFile   = fopen(base_path("database/seeders/csvs/customers1.csv"), "r");
        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {
                Customer::create([
                    'id'                        => in_array($data[0], ['', null]) ? null : $data[0],
                    'name'                      => in_array($data[1], ['', null]) ? null : $data[1],
                    'phone'                     => in_array($data[2], ['', null]) ? null : $data[2],
                    'needs'                     => in_array($data[3], ['', null]) ? null : $data[3],
                    'address'                   => in_array($data[4], ['', null]) ? null : $data[4],
                    'store'                     => in_array($data[5], ['', null]) ? null : $data[5],
                    'description'               => in_array($data[6], ['', null]) ? null : $data[6],
                    'response'                  => in_array($data[7], ['', null]) ? null : $data[7],
                    // 'total_price'               => in_array($data[8], ['', null]) ? null : $data[8],
                    'created_at'                => Carbon::now(),
                    'updated_at'                => Carbon::now()
                ]);
            }

            $firstline = false;
        }

        fclose($csvFile);
    }
}
