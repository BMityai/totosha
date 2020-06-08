<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryTypeSeeder extends Seeder
{
    private $deliveryTypes = [
        'сourier' => 'Курьером',
        'groundTransport' => 'Наземным транспортом',
        'airTransport' => 'Авиа транспортом'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->deliveryTypes as $code => $name){
            DB::table('delivery_types')->insert(
                ['code' => $code, 'name' => $name]
            );
        }
    }
}
