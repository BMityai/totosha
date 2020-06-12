<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
//            'name'              => 'required|string',
//            'category'          => 'required|numeric',
//            'manufacturer'      => 'required|numeric',
//            'age'               => 'required|numeric',
//            'height'            => 'required|numeric',
//            'width'             => 'required|numeric',
//            'depth'             => 'required|numeric',
//            'weight'            => 'required|numeric',
//            'img.*'             => 'image|mimes:jpeg,jpg,png,gif',
//            'material'          => 'required',
//            'costPrice'         => 'required',
//            'price'             => 'required',
//            'discount'          => 'required',
//            'priceWithDiscount' => 'required',
//            'count'             => 'required',
//            'recommended'       => 'required',
//            'new'               => 'required',
//            'comingSoon'        => 'required',
//            'note'              => 'required',
//            'description'       => 'required',
        ];
    }
}
