<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    private $positions = [
        'top',
        'bottom',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->positions as $position){
            DB::table('banners')->insert(
                ['position' => $position]
            );
        }
    }
}
