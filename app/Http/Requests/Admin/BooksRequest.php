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
        if ($this->isMethod('post')) {
            return [
                'category_id' => 'required|integer',
                'name_oz' => 'required',
                'name_uz' => 'required',
                'description_oz' => 'required',
                'description_uz' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'file' => 'required|mimes:doc,docx,pdf|max:51200',
                'status' => 'required|integer',
                'author_oz' => 'required',
                'author_uz' => 'required',
                'about_oz' => 'required',
                'about_uz' => 'required',
                'date' => 'required'
            ];
        }else {
            return [
                'category_id' => 'required|integer',
                'name_oz' => 'required',
                'name_uz' => 'required',
                'description_oz' => 'required',
                'description_uz' => 'required',
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'file' => 'nullable|mimes:doc,docx,pdf|max:51200',
                'status' => 'required|integer',
                'author_oz' => 'required',
                'author_uz' => 'required',
                'about_oz' => 'required',
                'about_uz' => 'required',
                'date' => 'required'
            ];
        }
    }
}
