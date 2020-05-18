<?php

namespace App\Http\Requests;

use App\Rules\DeliveryLocationRule;
use App\Rules\DeliveryTypeRule;
use Illuminate\Foundation\Http\FormRequest;

class DeliveryPriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'deliveryType'     => ['numeric', 'required', new DeliveryTypeRule($this->request->get('deliveryType'), $this->request->get('deliveryLocation'))],
            'deliveryLocation' => ['numeric', 'required', new DeliveryLocationRule($this->request->get('deliveryLocation'))],
        ];
    }
}
