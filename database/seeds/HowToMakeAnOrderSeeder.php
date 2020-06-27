<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HowToMakeAnOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('how_to_make_an_orders')->insert(
            ['content' => 'test']
        );
    }
}
