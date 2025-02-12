<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InterviewPeopleRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'full_name_oz' => 'required',
            'full_name_uz' => 'required',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'status' => 'required|boolean',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}
