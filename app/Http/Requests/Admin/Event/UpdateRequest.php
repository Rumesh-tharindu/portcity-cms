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
            'date_range' => 'required',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
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

    /**
 * Prepare the data for validation.
 */
protected function prepareForValidation(): void
{
    if($this->date_range){
        $multidate = explode(" - ", $this->date_range);

        $date_from = $multidate[0];
        $date_to = $multidate[1];

        $this->merge([
            'date_from' => \Carbon\Carbon::createFromFormat("m/d/Y", $date_from)->format('Y-m-d'),
            'date_to' => \Carbon\Carbon::createFromFormat("m/d/Y", $date_to)->format('Y-m-d'),
        ]);
    }

    if($this->time_from){
        $this->merge([
            'time_from' => \Carbon\Carbon::parse($this->time_from)->format('G:i'),
        ]);
    }

    if($this->time_to){
        $this->merge([
            'time_to' => \Carbon\Carbon::parse($this->time_to)->format('G:i'),
        ]);
    }

}
}
