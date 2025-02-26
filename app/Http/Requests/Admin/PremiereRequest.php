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
                'description_oz' => 'required',
                'description_uz' => 'required',
                'content_oz' => 'required',
                'content_uz' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'status' => 'required|integer',
                'category_id' => 'required'
            ];
        } else {
            return [
                'name_oz' => 'required',
                'name_uz' => 'required',
                'description_oz' => 'required',
                'description_uz' => 'required',
                'content_oz' => 'required',
                'content_uz' => 'required',
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'status' => 'required|integer',
                'category_id' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'name_oz.required' => 'Nomi maydoni to\'ldirish talab qilinadi',
            'name_uz.required' => 'Номи майдони тўлдириш талаб қилинади',
            'description_oz.required' => 'Qisqacha ma\'lumot maydoni to\'ldirish talab qilinadi',
            'description_uz.required' => 'Қисқача маълумот майдони тўлдириш талаб қилинади',
            'content_oz.required' => 'To\'liq ma\'lumotlar maydoni to\'lidirish talab qilinadi',
            'content_uz.required' => 'Тўлиқ маълумотлар майдони тўлидириш талаб қилинади',
            'image.required' => 'Rasm maydoni to\'ldirish talab qilinadi',
            'category_id.required' => 'Kategoriya maydoni to\'ldirish talab qilinadi',
        ];
    }
}
