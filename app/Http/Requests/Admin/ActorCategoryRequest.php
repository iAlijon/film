<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ActorCategoryRequest extends FormRequest
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
            'full_name_ru' => 'nullable|string',
            'full_name_en' => 'nullable|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => 'Ruxsat etilgan formatlar: jpg, jpeg, png',
            'image.required' => 'To\'ldirilishi majburiy bo\'lgan maydon',
            'image.max' => 'Rasm 2 megabaytdan oshmasligi kerak'
        ];
    }
}
