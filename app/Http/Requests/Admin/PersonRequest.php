<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
                'full_name_oz' => 'required',
                'full_name_uz' => 'required',
                'full_name_ru' => 'required',
                'full_name_en' => 'nullable',
                'description_oz' => 'required',
                'description_uz' => 'required',
                'description_ru' => 'required',
                'description_en' => 'nullable',
                'content_oz' => 'required',
                'content_uz' => 'required',
                'content_ru' => 'required',
                'content_en' => 'nullable',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'status' => 'required|integer',
                'birth_date' => 'required|date',
                'telegram_status' => 'nullable'
            ];
        }elseif ($this->isMethod('put')) {
            return [
                'category_id' => 'required',
                'full_name_oz' => 'required',
                'full_name_uz' => 'required',
                'full_name_ru' => 'required',
                'full_name_en' => 'nullable',
                'description_oz' => 'required',
                'description_uz' => 'required',
                'description_ru' => 'required',
                'description_en' => 'nullable',
                'content_oz' => 'required',
                'content_uz' => 'required',
                'content_ru' => 'required',
                'content_en' => 'nullable',
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'status' => 'required|integer',
                'birth_date' => 'required|date',
                'telegram_status' => 'nullable'
            ];
        }
    }
}
