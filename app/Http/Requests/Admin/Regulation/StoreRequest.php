<?php

namespace App\Http\Requests\Admin\Regulation;

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
            'title.en' => 'required|string|max:100',
            'description.en' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pdf' => Rule::filepond([
                'required',
                'file',
                'mimes:pdf',
                'max:204800',
            ]),
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'title.en.required' => 'The title field is required.',
            'title.en.max' => 'The title must not be greater than :max characters.',
            'description.en.required' => 'The description field is required.',
        ];
    }
}
