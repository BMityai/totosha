<?php

namespace App\Http\Requests;

use App\Rules\ProductAddOrDeleteToBasketRules;
use Illuminate\Foundation\Http\FormRequest;

class AddOrDeleteBasketProductRequest extends FormRequest
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
            'productId' => ['numeric', 'required', new ProductAddOrDeleteToBasketRules($this->request->get('productId'))]
        ];
    }
}
