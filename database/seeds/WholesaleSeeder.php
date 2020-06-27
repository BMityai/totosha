<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WholesaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wholesales')->insert(
            ['content' => 'test']
        );
    }
}
