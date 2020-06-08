<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{

    protected $countries = [
        'Китай',
        'Казахстан',
        'Россия',
        'Турция',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->countries as $country){
            DB::table('manufacturers')->insert(
                ['country' => $country]
            );
        }
    }
}
