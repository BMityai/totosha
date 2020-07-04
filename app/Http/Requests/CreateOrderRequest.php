<?php

namespace App\Http\Requests;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Rules\DeliveryLocationRule;
use App\Rules\DeliveryTypeRule;
use App\Rules\SpentBonusCheckRule;
use App\Services\BasketControllerService;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
        $service = new BasketControllerService(new MainEloquentRepository());
        $totalPrice = $service->getTotalPrice();

        $rules = [
            'spentBonus'    => ['numeric', 'max:' . $totalPrice,  new SpentBonusCheckRule($this->request->get('spentBonus'))],
            'name'          => ['required', 'string', 'min:2', 'max:20'],
            'phone'         => ['required', 'string', 'min:18', 'max:18'],
            'customerEmail' => ['required', 'email'],
            'region'        => ['required', 'numeric', new DeliveryLocationRule($this->request->get('region'))],
            'district'      => ['string', 'min:2'],
            'city'          => ['string', 'min:2'],
            'street'        => ['required', 'string', 'min:2'],
            'building'      => ['string', 'required'],
            'apartment'     => ['string'],
            'paymentType'   => ['numeric', 'required'],
            'deliveryType'  => [
                'numeric',
                'required',
                new DeliveryTypeRule($this->request->get('deliveryType'), $this->request->get('region'))
            ],
            'comment'       => ['string']
        ];
        if ($this->request->get('region') > 3) {
            array_push($rules['district'], 'required');
            array_push($rules['city'], 'required');
        }
        return $rules;
    }

    public function messages()
    {
        return ['spentBonus.max' => 'А без сдачи не найдется?'];
    }
}
