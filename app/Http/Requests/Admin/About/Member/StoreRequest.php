<?php

namespace App\Http\Requests\Admin\About\Member;

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
            'name.en' => 'required|string|max:100',
            'designation.en' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.en.required' => 'The name field is required.',
            'designation.en.required' => 'The designation field is required.',
        ];
    }
}
