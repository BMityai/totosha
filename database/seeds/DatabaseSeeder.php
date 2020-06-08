<?php

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
         $this->call(PaymentFormSeeder::class);
         $this->call(DeliveryTypeSeeder::class);
         $this->call(KazPostTarifSeeder::class);
         $this->call(AgeSeeder::class);
         $this->call(ManufacturerSeeder::class);
    }
}
