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
            'title.en' => 'required',
            'license_number' => 'required|string|max:50',
            'description.en' => 'required',
            'address' => 'required|string|max:100',
            'status' => 'required',
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The type field is required.',
            'title.en.required' => 'The title field is required.',
            'description.en.required' => 'The description field is required.',
        ];
    }
}
