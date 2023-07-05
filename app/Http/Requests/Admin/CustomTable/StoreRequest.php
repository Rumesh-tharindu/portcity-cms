<?php

namespace App\Http\Requests\Admin\CustomTable;

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
            'name.en' => 'nullable|string||max:100',
            'table_data.en' => 'required|string',
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.en.required' => 'The name field is required.',
            'name.en.max' => 'The name must not be greater than :max characters.',
            'table_data.en.required' => 'The table field is required.',

        ];
    }
}
