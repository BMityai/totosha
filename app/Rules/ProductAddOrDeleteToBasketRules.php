<?php

namespace App\Rules;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use Illuminate\Contracts\Validation\Rule;

class ProductAddOrDeleteToBasketRules implements Rule
{
    /**
     * @var int
     */
    private $productId;

    /**
     * @var MainEloquentRepository
     */
    private $dbRepository;

    /**
     * Create a new rule instance.
     *
     * @param int $productId
     */
    public function __construct(int $productId)
    {
        $this->productId    = $productId;
        $this->dbRepository = new MainEloquentRepository();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = $this->dbRepository->getActiveProductById($this->productId);
        if (count($product) == 0) {
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
        return 'Товар не найден';
    }
}
