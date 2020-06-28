<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSettingsSeeder extends Seeder
{
    private $settings = [
        ['title' => 'О нас', 'slug' => 'about_us', 'content' => 'About us test content'],
        ['title' => 'Оплата и доставка', 'slug' => 'payment_and_delivery', 'content' => 'Payment and delivery test content'],
        ['title' => 'Возврат товара', 'slug' => 'purchase_returns', 'content' => 'Purchase returns test content'],
        ['title' => 'Как оформить заказ?', 'slug' => 'how_to_make_an_order', 'content' => 'How to make an order test content'],
        ['title' => 'Бонусная программа', 'slug' => 'loyalty_program', 'content' => 'Loyalty program test content'],
        ['title' => 'Контакты', 'slug' => 'contacts', 'content' => 'Contacts test content'],
        ['title' => 'Оптовые продажи', 'slug' => 'wholesales', 'content' => 'Wholesales test content'],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $setting) {
            DB::table('content_settings')->insert(
                ['title' => $setting['title'], 'slug' => $setting['slug'], 'content' => $setting['content']]
            );
        }
    }
}
