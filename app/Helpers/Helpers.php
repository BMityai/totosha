<?php


namespace App\Helpers;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    /**
     * Filter unneedet elements from phone number
     * return it clean
     *
     * @param string $phone
     * @return string
     */
    public static function getCleanPhone(string $phone): string
    {
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace('-', '', $phone);
        $phone = str_replace(' ', '', $phone);
        return $phone;
    }

    /**
     * Filter unneedet elements from date
     * return it clean
     *
     * @param string $birthDate
     * @return string
     */
    public static function getCleanBirthDate(string $birthDate): string
    {
        $dateParams           = explode("/", $birthDate);
        $birthDate = $dateParams[2] . '-' . $dateParams[1] . '-' .$dateParams[0];
        return $birthDate;
    }

    /**
     * Generate order number
     *
     * @param int $regionId
     * @return string
     */
    public static function generateOrderNumber(int $regionId): string
    {
        $prefix = '0';
        $suffix = '0';
        if($regionId == 1){
            $prefix = '1';
        }

        if(Auth::check()){
            $suffix = '1';
        }

        $orderDate = Carbon::now()->getTimestamp();
        $startDate=new Carbon('05-06-2019');
        $endPart = $orderDate - $startDate->getTimestamp();
        return $prefix . $suffix . $endPart . mt_rand(0, 9);
    }
}
