<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    private $regions = [
        'г.Алматы',
        'г.Нур-Султан',
        'г.Шымкент',
        'Алматинская область',
        'Акмолинская область',
        'Актюбинская область',
        'Атырауская область',
        'Восточно-Казахстанская область',
        'Жамбылская область',
        'Западно-Казахстанская область',
        'Карагандинская область',
        'Костанайская область',
        'Кызылординская область',
        'Мангистауская область',
        'Павлодарская область',
        'Северо-Казахстанская область',
        'Туркестанская область'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->regions as $region){
            DB::table('regions')->insert(
                ['region'   => $region]
            );
        }
    }
}
