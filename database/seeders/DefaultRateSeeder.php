<?php

namespace Database\Seeders;

use App\Models\DefaultRate;
use Illuminate\Database\Seeder;

class DefaultRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DefaultRate::create([
        	'default_rate'=>'2.23',
        	'created_by'=> 1,
        ]);
    }
}
