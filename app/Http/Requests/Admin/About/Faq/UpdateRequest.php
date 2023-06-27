<?php

namespace App\Http\Requests\Admin\About\Faq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'question.en' => 'required|string|max:100',
            'answer.en' => 'required',
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'question.en.required' => 'The question field is required.',
            'question.en.max' => 'The question must not be greater than :max characters.',
            'answer.en.required' => 'The answer field is required.',
        ];
    }
}
