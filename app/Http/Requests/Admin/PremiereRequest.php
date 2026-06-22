<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

        return [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|integer',
            'category_id' => 'required',
            'telegram_status' => 'nullable',
            'translates' => 'required',
            Rule::dimensions()->minWidth(640)->minHeight(730)->maxWidth(1920)->maxHeight(1080)
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nomi maydoni to\'ldirish talab qilinadi',
            'description.required' => 'Qisqacha ma\'lumot maydoni to\'ldirish talab qilinadi',
            'content.required' => 'To\'liq ma\'lumotlar maydoni to\'lidirish talab qilinadi',
            'image.required' => 'Rasm maydoni to\'ldirish talab qilinadi',
            'category_id.required' => 'Kategoriya maydoni to\'ldirish talab qilinadi',
            'image.dimensions' => 'Rasm o\'lchamlari mos emas min 640X730 max 1920X1080 bo\'lishi kerak'
        ];
    }
}
