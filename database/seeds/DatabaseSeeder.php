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
         $this->call(MaterialSeeder::class);
         $this->call(BannerSeeder::class);
         $this->call(AboutUsSeeder::class);
         $this->call(PaymentAndDeliverySeeder::class);
         $this->call(PurchaseReturns::class);
         $this->call(HowToMakeAnOrderSeeder::class);
         $this->call(LoyaltyProgramSeeder::class);
         $this->call(ContactsSeeder::class);
         $this->call(WholesaleSeeder::class);
    }
}
