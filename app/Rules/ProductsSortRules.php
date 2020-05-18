<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductsSortRules implements Rule
{
    /**
     * @var string
     */
    private $sort;

    /**
     * Create a new rule instance.
     *
     * @param null|string $sort
     */
    public function __construct(?string $sort)
    {
        $this->sort = $sort;
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
        if(is_null($this->sort) || $this->sort == 'priceUp' || $this->sort == 'priceDown' || $this->sort == 'new'){
            return true;
        };
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Так делать нельзя!!!';
    }
}
