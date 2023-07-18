<?php

namespace App\Http\Requests\Admin\PublicRegistry\PublicRegistry;

use Illuminate\Foundation\Http\FormRequest;

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
            'category_id' => 'required',
            'title.en' => 'required|string|max:100',
            'license_number' => 'required|string|max:50',
            'description.en' => 'required',
            'address.en' => 'required|string|max:100',
            'status' => 'sometimes|boolean',
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The type field is required.',
            'title.en.required' => 'The title field is required.',
            'title.en.max' => 'The title field must not be greater than :max characters.',
            'description.en.required' => 'The description field is required.',
            'address.en.required' => 'The address field is required.',
            'address.en.max' => 'The address field must not be greater than :max characters.',
        ];
    }
}
