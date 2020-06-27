<?php

use Illuminate\Database\Seeder;

class PaymentAndDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_and_deliveries')->insert(
            ['content' => 'test']
        );
    }
}
