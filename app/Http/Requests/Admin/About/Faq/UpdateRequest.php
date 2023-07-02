<?php

namespace App\Http\Requests\Admin\Event;

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
            'title.en' => 'required|string|max:100',
            'date_from' => 'required|date',
            'date_to' => 'required_without,one_day|date',
            'time_from' => 'required',
            'time_to' => 'required',
            'description.en' => 'nullable',
            'location.en' => 'nullable',
            'ticket.en' => 'nullable',
            'sort' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'title.en.required' => 'The title field is required.',
            'title.en.max' => 'The title must not be greater than :max characters.',
            'description.en.required' => 'The description field is required.',
            'location.en.required' => 'The location field is required.',
            'ticket.en.required' => 'The ticket field is required.',
        ];
    }
}
