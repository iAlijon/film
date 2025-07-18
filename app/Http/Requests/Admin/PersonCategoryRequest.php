<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PersonCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_oz' => 'required',
            'name_uz' => 'required',
            'name_ru' => 'required',
            'name_en' => 'nullable',
            'status' => 'required|integer',
            'menu' => 'required|string',
            'order' => 'required'
        ];
    }
}
