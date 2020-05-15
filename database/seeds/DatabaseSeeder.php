<?php

use App\PaymentForm;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RegionSeeder::class);
         $this->call(OrderStatusSeeder::class);
         $this->call(PaymentForm::class);
         $this->call(DeliveryTypeSeeder::class);
         $this->call(KazPostTarifSeeder::class);
    }
}
