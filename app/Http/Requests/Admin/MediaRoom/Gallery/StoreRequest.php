<?php

namespace App\Http\Requests\Admin\MediaRoom\Gallery;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'year' => 'required|numeric|max:' . date('Y'),
            'images.*' => Rule::filepond([
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ]),
            'video.*' => Rule::filepond([
                'nullable',
                'file',
                'mimes:mp4,ogx,oga,ogv,ogg,webm',
                //'max:2048',
            ]),
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
