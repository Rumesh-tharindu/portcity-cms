<?php

namespace App\Http\Requests\Admin\About\FaqType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'type.en' => 'required|string|max:200',
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'type.en.required' => 'The type field is required.',
            'type.en.max' => 'The question must not be greater than :max characters.',
        ];
    }
}
