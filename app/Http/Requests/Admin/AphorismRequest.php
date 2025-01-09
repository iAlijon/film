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
            'status' => 'required|boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
