<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PremiereRequest extends FormRequest
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
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'status' => 'required|integer',
                'category_id' => 'required',
                'telegram_status' => 'nullable'
            ];
        } else {
            return [
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
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'status' => 'required|integer',
                'category_id' => 'required',
                'telegram_status' => 'nullable '
            ];
        }
    }

    public function messages()
    {
        return [
            'name_oz.required' => 'Nomi maydoni to\'ldirish talab qilinadi',
            'name_uz.required' => 'Номи майдони тўлдириш талаб қилинади',
            'name_ru.required' => 'Поле «Имя» обязательно для заполнения.',
            'name_en.required' => 'The name field is required.',
            'description_oz.required' => 'Qisqacha ma\'lumot maydoni to\'ldirish talab qilinadi',
            'description_uz.required' => 'Қисқача маълумот майдони тўлдириш талаб қилинади',
            'description_ru.required' => 'Обязательно заполните краткое информационное поле.',
            'description_en.required' => 'A short information field is required.',
            'content_oz.required' => 'To\'liq ma\'lumotlar maydoni to\'lidirish talab qilinadi',
            'content_uz.required' => 'Тўлиқ маълумотлар майдони тўлидириш талаб қилинади',
            'content_ru.required' => 'Поле данных обязательно для заполнения.',
            'content_en.required' => 'Complete data field is required.',
            'image.required' => 'Rasm maydoni to\'ldirish talab qilinadi',
            'category_id.required' => 'Kategoriya maydoni to\'ldirish talab qilinadi',
        ];
    }
}
