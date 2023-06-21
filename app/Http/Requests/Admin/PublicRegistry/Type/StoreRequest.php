<?php

namespace App\Http\Requests\Admin\PublicRegistry\Type;

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
            'name.en' => 'required',
            'page_id' => 'required',
            'section' => 'required',
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.en.required' => 'The name field is required.',
            'page_id.required' => 'The page field is required.',
        ];
    }
}
