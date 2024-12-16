<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AnimationRequest extends FormRequest
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
            'name_oz' => 'required|string',
            'name_uz' => 'required|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'status' => 'required|boolean',
            'images' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
