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
                'full_name' => 'required|string',
                'description' => 'required',
//                'calendar.*' => 'required',
                'status' => 'required|integer',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'translates' => 'required|in:oz,uz,ru,en',
                'order' => 'required',
            ];
        }else {
            return [
                'full_name' => 'required|string',
                'description' => 'required',
//                'calendar.*' => 'required',
                'status' => 'required|integer',
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'translates' => 'required|in:oz,uz,ru,en',
                'order' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
//            'calendar.*.required' => 'Taqvim maydoni to\'lidirish tablab etiladi',
            'image.required' => 'Rasm maydoni to\'ldirish talab qilinadi',
            'full_name' => 'F.I.O maydoni to\'ldirish talab qilinadi',
            'description' => 'Qisqacha ma\'lumot maydoni to\'ldirish talab qilinadi',
        ];
    }
}
