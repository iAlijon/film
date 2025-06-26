<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilmAnalysisRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'category_id' => 'required',
                'name_oz' => 'required',
                'name_uz' => 'required',
                'name_ru' => 'required',
                'name_en' => 'nullable',
                'description_oz' => 'required',
                'description_uz' => 'required',
                'description_ru' => 'required',
                'description_en' => 'nullable',
                'content_oz' => 'required',
                'content_uz' => 'required',
                'content_ru' => 'required',
                'content_en' => 'nullable',
                'status' => 'required|integer',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ];
        }else {
            return [
                'category_id' => 'required',
                'name_oz' => 'required',
                'name_uz' => 'required',
                'name_ru' => 'required',
                'name_en' => 'nullable',
                'description_oz' => 'required',
                'description_uz' => 'required',
                'description_ru' => 'required',
                'description_en' => 'nullable',
                'content_oz' => 'required',
                'content_uz' => 'required',
                'content_ru' => 'required',
                'content_en' => 'nullable',
                'status' => 'required|integer',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ];
        }
    }
}
