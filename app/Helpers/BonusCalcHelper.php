<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Auth;

class BonusCalcHelper
{
    /**
     * Get bonus date
     *
     * @return float
     */
    public function getBonusCoefficient(): float
    {
        if (Auth::check()){
            return $this->calculateBonusCoefficient();
        } else {
            return 0;
        }
    }

    /**
     * Calculate bonus coefficient by birth date
     *
     * @return float
     */
    private function calculateBonusCoefficient(): float
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
