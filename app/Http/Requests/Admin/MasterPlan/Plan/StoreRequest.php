<?php

namespace App\Http\Requests\Admin\MasterPlan\Plan;

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
            'title.en' => 'required|string|max:200',
            'description.en' => 'required',
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
