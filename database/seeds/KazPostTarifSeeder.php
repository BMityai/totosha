<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KazPostTarifSeeder extends Seeder
{
    private $tarif = [
        ['delivery_type_id' => 1, 'value' => '2000-4999', 'price' => 500],
        ['delivery_type_id' => 1, 'value' => '> 5000', 'price' => 0],
        ['delivery_type_id' => 2, 'value' => '0 - 2', 'price' => 1200],
        ['delivery_type_id' => 2, 'value' => '2 - 3', 'price' => 1300],
        ['delivery_type_id' => 2, 'value' => '3 - 6', 'price' => 1600],
        ['delivery_type_id' => 2, 'value' => '6 - 9', 'price' => 2000],
        ['delivery_type_id' => 2, 'value' => '9 - 12', 'price' => 2300],
        ['delivery_type_id' => 2, 'value' => '12 - 14', 'price' => 2700]
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->tarif as $tarif) {
            DB::table('kaz_post_tarifs')->insert(
                [
                    'delivery_type_id' => $tarif['delivery_type_id'],
                    'value'            => $tarif['value'],
                    'price'            => $tarif['price'],
                ]
            );
        }
    }
}
