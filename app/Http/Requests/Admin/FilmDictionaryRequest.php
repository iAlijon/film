<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilmDictionaryRequest extends FormRequest
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
            'name_oz' => 'required|string',
            'name_uz' => 'required|string',
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
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required|boolean',
            'dictionary_id' => 'required|array|unique:film_dictionary_categories,dictionary_category_id'
        ];
    }

    public function messages()
    {
        return [
          'dictionary_id.unique' => 'You have selected similar elements.'
        ];
    }
}
