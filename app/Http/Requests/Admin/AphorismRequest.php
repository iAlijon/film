<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AphorismRequest extends FormRequest
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
                'full_name_oz' => 'required|string',
                'full_name_uz' => 'required|string',
                'full_name_ru' => 'required|string',
                'description_oz' => 'required',
                'description_uz' => 'required',
                'description_ru' => 'required',
                'calendar.*.description_oz' => 'required',
                'calendar.*.description_uz' => 'required',
                'calendar.*.description_ru' => 'required',
                'status' => 'required|integer',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ];
        }else {
            return [
                'full_name_oz' => 'required|string',
                'full_name_uz' => 'required|string',
                'full_name_ru' => 'required|string',
                'description_oz' => 'required',
                'description_uz' => 'required',
                'description_ru' => 'required',
                'calendar.*.description_oz' => 'required',
                'calendar.*.description_uz' => 'required',
                'calendar.*.description_ru' => 'required',
                'status' => 'required|integer',
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
            ];
        }
    }

    public function messages()
    {
        return [
            'calendar.*.description_oz.required' => 'The form oz field is required',
            'calendar.*.description_uz.required' => 'The form uz field is required',
            'calendar.*.description_ur.required' => 'The form uz field is required',
            'image.required' => 'Rasm maydoni to\'ldirish talab qilinadi',
            'full_name_oz' => 'F.I.O maydoni to\'ldirish talab qilinadi',
            'full_name_uz' => 'Ф.И.О майдони тўлдириш талаб қилинади',
            'full_name_ru' => 'Поле «Полное имя» обязательно для заполнения.',
            'description_oz' => 'Qisqacha ma\'lumot maydoni to\'ldirish talab qilinadi',
            'description_uz' => 'Қисқача маълумот майдони тўлдириш талаб қилинади',
            'description_ru' => 'Обязательно заполните краткое информационное поле.',
        ];
    }
}
