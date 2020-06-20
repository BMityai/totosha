<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
            'name'        => 'required|string|min:2|unique:categories,name',
            'is_active'   => 'required|min:0|max:1|numeric',
            'description' => 'required|string|min:10',
            'img'         => 'required',
            'img.*'       => 'image|mimes:jpeg,jpg,png,gif',
        ];

        if($this->route()->named('admin.editCategory')){
            $rules['name'] .= ',' . $this->categoryId;
            unset($rules['img']);
        }
        return $rules;
    }
}
