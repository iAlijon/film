<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RejissorRequest extends FormRequest
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
            'full_name_oz' => 'required|string',
            'full_name_uz' => 'required|string',
            'full_name_ru' => 'required|string',
            'full_name_en' => 'required|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
            'images' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}
