<?php

namespace App\Rules;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use Illuminate\Contracts\Validation\Rule;

class BasketProductCountChangeRule implements Rule
{
    /**
     * @var int
     */
    private $productId;

    /**
     * @var int
     */
    private $count;

    /**
     * @var MainEloquentRepository
     */
    private $dbRepository;

    /**
     * Create a new rule instance.
     *
     * @param int $productId
     * @param int $count
     */
    public function __construct(int $productId, int $count)
    {
        $this->productId = $productId;
        $this->count     = $count;
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
        $product = $this->dbRepository->getActiveProductById($this->productId)->first();

        if ( $this->count > $product->count){
            return false;
        };
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Количество товара ограничено';
    }
}
