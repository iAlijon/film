<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InterviewRequest extends FormRequest
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
            'name_ru' => 'nullable|string',
            'name_en' => 'nullable|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'nullable',
            'description_en' => 'nullable',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'content_ru' => 'nullable',
            'content_en' => 'nullable',
            'images' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name_oz' => 'Name(OZ) maydonini to\'ldirish majburiy',
            'name_uz' => 'Name(UZ) maydonini to\'ldirish majburiy',
            'description_oz' => 'Description(OZ) maydonini to\'ldirish majburiy',
            'description_uz' => 'Description(UZ) maydonini to\'ldirish majburiy',
            'images' => 'Rasm maydonini to\'ldirish majburiy',
            'content_oz' => 'Content(OZ) maydonini to\'ldirish majburiy',
            'content_uz' => 'Content(UZ) maydonini to\'ldirish majburiy',
        ];
    }
}
