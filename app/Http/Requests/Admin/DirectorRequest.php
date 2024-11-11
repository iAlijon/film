<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DirectorRequest extends FormRequest
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
            'full_name_oz' => 'required',
            'full_name_uz' => 'required',
            'full_name_ru' => 'nullable',
            'full_name_en' => 'nullable',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'nullable',
            'description_en' => 'nullable',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'content_ru' => 'nullable',
            'content_en' => 'nullable',
            'images' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'birth_date' => 'required|date'
        ];
    }
}
