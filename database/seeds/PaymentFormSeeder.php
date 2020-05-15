<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentFormSeeder extends Seeder
{
    private $paymentType = [
            'cash' => 'Наличными курьеру',
            'creditCard' => 'Банковкой картой',
        ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->paymentType as $code => $name){
            DB::table('payment_forms')->insert(
                ['code' => $code, 'name' => $name]
            );
        }
    }
}
