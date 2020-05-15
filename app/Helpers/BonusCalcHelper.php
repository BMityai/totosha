<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Auth;

class BonusCalcHelper
{
    public function getBonusCoefficient()
    {
        if (Auth::check()){
            return $this->calculateBonusCoefficient();
        } else {
            return 1;
        }
    }

    private function calculateBonusCoefficient()
    {
        $user = Auth::user();
        $bonusPercent = config('app.bonusPercent');
        $dateParams = explode("-", $user->birth_date);
        if((int)$dateParams[2] == (int)date('d') && (int)$dateParams[1] == (int)date('m')){
            return (float)$bonusPercent * 2;
        } else {
            return (float)$bonusPercent;
        }
    }
}
