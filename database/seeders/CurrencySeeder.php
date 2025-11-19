<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(database_path('seeders/master_currency_data.csv'), 'r');

        while (($line = fgetcsv($file)) !== FALSE) {
            DB::table('master_currency')->insert([
                'currency_short_name' => $line[0],
                'currency_long_name' => $line[1],
                'symbol' => $line[2],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        fclose($file);
    }
}
