<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InterviewRequest extends FormRequest
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
            'interview_category_id' => 'required',
            'interview_people_id' => 'required',
            'interview_oz' => 'required|string',
            'interview_uz' => 'required|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'status' => 'required|boolean',
        ];
    }
}
