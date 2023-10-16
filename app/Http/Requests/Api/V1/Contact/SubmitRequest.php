<?php

namespace App\Http\Requests\Api\V1\Contact;

use Illuminate\Foundation\Http\FormRequest;

class SubmitRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'page_id' => 7,

        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'page_id' => 'sometimes|exists:pages,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email:rfc,dns',
            'country' => 'required|string',
            'company' => 'required|string',
            'type' => ['required' , /* 'in:inquiry,complain' */],
            'contact_number' => 'required|string|min:10|regex:#^[0-9-,+]+$#',
            'message' => 'required|string|between:3,1000',
            //'g-recaptcha-response' => 'recaptcha',
        ];
    }

    public function attributes()
    {
        return [
        ];
    }
}
