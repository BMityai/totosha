<?php

namespace App\Rules;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use Illuminate\Contracts\Validation\Rule;

class DeliveryTypeRule implements Rule
{
    private $deliveryTypeId;
    /**
     * @var MainEloquentRepository
     */

    private $dbRepository;
    /**
     * @var int
     */
    private $deliveryLocationId;

    /**
     * Create a new rule instance.
     *
     * @param $deliveryTypeId
     * @param $deliveryLocationId
     */
    public function __construct($deliveryTypeId, $deliveryLocationId)
    {
        $this->deliveryTypeId = $deliveryTypeId;
        $this->deliveryLocationId = $deliveryLocationId;
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
        $deliveryType = $this->dbRepository->getAvtiveDeliveryTypeById($this->deliveryTypeId);
        if (count($deliveryType) == 0){
            return false;
        }

        if($this->deliveryLocationId == 1 && $this->deliveryTypeId != 1){
            return false;
        }

        if($this->deliveryLocationId != 1 && $this->deliveryTypeId == 1){
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
        return 'Этот тип доставки не доступен';
    }
}
