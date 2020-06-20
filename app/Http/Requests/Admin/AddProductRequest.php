<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        $rules = [
            'name'         => 'required|string|unique:products,name',
            'category'     => 'required|numeric',
            'manufacturer' => 'required|numeric',
            'age'          => 'required|numeric',
            'height'       => 'required|numeric',
            'width'        => 'required|numeric',
            'depth'        => 'required|numeric',
            'weight'       => 'required|numeric',
            'img'          => 'required',
            'img.*'        => 'image|mimes:jpeg,jpg,png,gif',
            'material'     => 'required|numeric',
            'costPrice'    => 'required|numeric',
            'price'        => 'required|numeric',
            'discount'     => 'numeric',
            'count'        => 'required|numeric',
            'recommended'  => 'required|numeric',
            'new'          => 'required|numeric',
            'comingSoon'   => 'required|numeric',
            'note'         => 'string',
            'description'  => 'required',
        ];

        if($this->route()->named('admin.editProduct')){
            $rules['name'] .= ',' . $this->productId;
            unset($rules['img']);
        }
        return $rules;
    }
}
