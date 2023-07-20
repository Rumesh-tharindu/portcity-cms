<?php

namespace App\Http\Requests\Admin\MediaRoom\Gallery;

use App\Rules\CommaSeparatedUrl;
use App\Rules\CommaSeparatedUrls;
use App\Rules\YouTubeUrl;
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
            'year' => 'required|numeric|unique:galleries,year,NULL,id,deleted_at,NULL|max:' . date('Y'),
            'gallery' => 'required|array',
            'gallery.*.image' => [
                'required_with:gallery',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
            'gallery.*.video_url' => ['nullable', 'string', 'url', new YouTubeUrl],
            'gallery.*.sort' => 'nullable|numeric|min:0',

        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function attributes()
    {
        return [
            'gallery.*.image' => "gallery :position image",
            'gallery.*.video_url' => "gallery :position video url",
            'gallery.*.sort' => "gallery :position sort",
        ];
    }
}
