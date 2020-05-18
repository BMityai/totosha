<?php

namespace App\Rules;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use Illuminate\Contracts\Validation\Rule;

class DeliveryLocationRule implements Rule
{
    private $deliveryLocationId;
    /**
     * @var MainEloquentRepository
     */
    private $dbRepository;

    /**
     * Create a new rule instance.
     *
     * @param $deliveryLocationId
     */
    public function __construct($deliveryLocationId)
    {
        $this->deliveryLocationId = (int)$deliveryLocationId;
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
        $deliveryLocation = $this->dbRepository->getActiveDeliveryLocationById($this->deliveryLocationId);
        if(count($deliveryLocation) == 0) {
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
        return 'Доставка в указанную область не осуществляется';
    }
}
