<?php

namespace App\Http\Requests;

use App\Rules\ProductsFilterByStockRules;
use App\Rules\ProductsSortRules;
use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'sort'        => ['nullable', 'string', new ProductsSortRules($this->request->get('sort'))],
            'stockFilter' => ['nullable', 'string', new ProductsFilterByStockRules($this->request->get('stockFilter'))],
            'priceFrom'   => 'nullable|numeric|min:0|',
            'priceTo'     => 'nullable|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'string'  => 'Введите корректное значение',
            'min'     => 'Введите корректное значение',
            'numeric' => 'Введите корректное значение'
        ];
    }
}
