<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KinogidRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required',
//            'telegram_status' => 'nullable',
            'order' => 'required',
            'translates' => 'required',
            'creatorRoles' => 'required',
            'width_ratio'  => 'required|integer|min:1|max:100',
            'height_ratio' => 'required|integer|min:1|max:100',
        ];
    }
}
