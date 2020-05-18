<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductsFilterByStockRules implements Rule
{
    /**
     * @var string|null
     */
    private $stockFilter;

    /**
     * Create a new rule instance.
     *
     * @param string|null $stockFilter
     */
    public function __construct(?string $stockFilter)
    {
        $this->stockFilter = $stockFilter;
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
        if(is_null($this->stockFilter) || $this->stockFilter == 'inStock' || $this->stockFilter == 'comingSoon'){
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
