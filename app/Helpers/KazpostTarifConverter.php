<?php


namespace App\Helpers;


class KazpostTarifConverter
{
    public function convertValueByPrice($price)
    {
        if ($price >= 5000){
            return '> 5000';
        } else {
            return '2000-4999';
        }
    }

    public function convertValueByWeight($weight)
    {
        switch ($weight){
            case ($weight <= 1.8):
                return '0 - 2';
                break;
            case ($weight > 1.8 && $weight <= 2.8):
                return '2 - 3';
                break;
            case ($weight > 2.8 && $weight <= 5.8):
                return '3 - 6';
                break;
            case ($weight > 5.8 && $weight <= 8.8):
                return '6 - 9';
                break;
            case ($weight > 8.8 && $weight <= 11.8):
                return '9 - 12';
                break;
            case ($weight > 11.8 && $weight <= 13.8):
                return '12 - 14';
                break;
        }

    }



}
