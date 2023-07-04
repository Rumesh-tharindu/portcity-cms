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
            'th.en' => 'required|string|max:100',
            'td.en' => 'nullable|string|max:100',
            'sort' => 'sometimes|numeric|min:0',

            'custom_table_rows' => 'required|array',
            'custom_table_rows.*.th.en' => 'required_with:custom_table_rows|distinct',
            'custom_table_rows.*.td.en' => 'required_with:custom_table_rows|string',
        ];
    }

    public function messages()
    {
        return [
            'name.en.required' => 'The name field is required.',
            'name.en.max' => 'The name must not be greater than :max characters.',
            'custom_table_rows.*.th.en.required_with' => 'The th field is required.',
            'custom_table_rows.*.td.en.required_with' => 'The td field is required.',
       ];
    }
}
