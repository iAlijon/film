<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'file' => 'nullable|mimes:doc,docx,pdf|max:51200',
            'status' => 'required|integer',
            'author' => 'required',
            'about' => 'required',
            'date' => 'required',
            'translates' => 'required',
            'order' => 'required',
            'width_ratio'  => 'required|integer|min:1|max:100',
            'height_ratio' => 'required|integer|min:1|max:100',
        ];
    }
}
