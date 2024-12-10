<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CinemaFactRequest extends FormRequest
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
            'name_ru' => 'nullable',
            'name_en' => 'nullable',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'nullable',
            'description_en' => 'nullable',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'content_ru' => 'nullable',
            'content_en' => 'nullable',
            'status' => 'required|boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
