<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DocumentaryRequest extends FormRequest
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
            'name_oz' =>'required',
            'name_uz' =>'required',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'image' => 'required|image|mimes:png,jpeg,jpg|max:2048',
            'status' => 'required|boolean'
        ];
    }
}
