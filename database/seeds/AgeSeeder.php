<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeSeeder extends Seeder
{
    private $ages = [
        '+0',
        '+0,5',
        '+1',
        '+1,5',
        '+2',
        '+3',
        '+4',
        '+5',
        '+6',
        '+7',
        '+8',
        '+9',
        '+10',
        '+11',
        '+12',
        '+13',
        '+14',
        '+15',
        '+16',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->ages as $age){
            DB::table('ages')->insert(
                ['age' => $age]
            );
        }
    }
}
