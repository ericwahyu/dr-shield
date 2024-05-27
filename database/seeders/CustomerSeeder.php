<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'customers';
		$this->filename = base_path().'/database/seeders/csvs/customers.csv';
        $this->mapping = [
            0 => 'id',
            1 => 'date',
            // 5 => 'age',
        ];
	}

	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		DB::table($this->table)->truncate();

		parent::run();
	}
}
