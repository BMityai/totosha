<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    protected $materials = [
        'дерево',
        'пластик',
        'металл',
        'дерево + пластик',
        'дерево + металл',
        'металл + пластик',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->materials as $material){
            DB::table('materials')->insert(
                ['name' => $material]
            );
        }
    }
}
