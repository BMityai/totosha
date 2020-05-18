<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SpentBonusCheckRule implements Rule
{
    /**
     * @var int
     */
    private $spentBonus;

    /**
     * Create a new rule instance.
     *
     * @param int|null $spentBonus
     */
    public function __construct($spentBonus)
    {
        $this->spentBonus = $spentBonus;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_null($this->spentBonus) && Auth::user()->bonus < $this->spentBonus){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Недостаточно средств на бонусном счету';
    }
}
