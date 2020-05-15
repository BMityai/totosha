<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    private $statuses = [
        'new'                => 'Новый',
        'confirmed'          => 'Подтвержден',
        'transferredToDS'    => 'Передан в службу доставки',
        'complete'           => 'Выполнен',
        'canceledByCustomer' => 'Отменен клиентом',
        'cancelledByStore'   => 'Отменен магазином',
        'returnRequested'    => 'Требует возврата',
        'returnByCustomer'   => 'Возврат от клиента'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses as $code => $name){
            DB::table('order_statuses')->insert(
                ['code' => $code, 'name' => $name]
            );
        }
    }
}
