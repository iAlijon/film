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
        return [
            'full_name_oz' => 'required|string',
            'full_name_uz' => 'required|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'calendar.*.description_oz' => 'required',
            'calendar.*.description_uz' => 'required',
            'status' => 'required|integer',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'calendar.*.description_oz.required' => 'The form oz field is required',
            'calendar.*.description_uz.required' => 'The form uz field is required'
        ];
    }
}
