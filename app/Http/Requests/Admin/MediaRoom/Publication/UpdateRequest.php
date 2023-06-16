<?php

namespace App\Http\Requests\Admin\MediaRoom\Publication;

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
            'title.en' => 'required|max:100',
            'summary.en' => 'nullable',
            'description.en' => 'nullable',
            'category_id' => 'required',
            'source' => 'nullable|url',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'published_at' => 'required|date_format:Y-m-d|before_or_equal:today',
            'slider_images.*' => Rule::filepond([
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ]),
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'title.en.required' => 'The title field is required.',
            'title.en.max' => 'The title field must not be greater than :max characters.',
            'summary.en.required' => 'The summary field is required.',
            'description.en.required' => 'The description field is required.',
            'category_id.required' => 'The category field is required.',
        ];
    }
}