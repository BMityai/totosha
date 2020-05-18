<?php

namespace App\Rules;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use Illuminate\Contracts\Validation\Rule;

class PaymentTypeRule implements Rule
{
    /**
     * @var int
     */
    private $paymentTypeId;
    /**
     * @var MainEloquentRepository
     */
    private $dbRepository;

    /**
     * Create a new rule instance.
     *
     * @param int $paymentTypeId
     */
    public function __construct(int $paymentTypeId)
    {
        $this->paymentTypeId = $paymentTypeId;
        $this->dbRepository = new MainEloquentRepository();
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
        $paymentType = $this->dbRepository->getActivePaymentTypeById($this->paymentTypeId);
        if (count($paymentType) == 0){
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
        return 'Неверный тип оплаты';
    }
}
