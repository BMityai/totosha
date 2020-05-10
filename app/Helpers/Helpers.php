<?php


namespace App\Helpers;


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
}
