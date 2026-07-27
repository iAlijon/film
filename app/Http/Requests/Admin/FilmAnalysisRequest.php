<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilmAnalysisRequest extends FormRequest
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
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'status' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'telegram_status' => 'nullable',
            'order' => 'required',
            'translates' => 'required',
            'width_ratio'  => 'required|integer|min:1|max:100',
            'height_ratio' => 'required|integer|min:1|max:100',
        ];
    }
}
