<?php

namespace App\Http\Requests\Admin\MediaRoom\Gallery;

use App\Rules\CommaSeparatedUrls;
use App\Rules\YouTubeUrl;
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
            'year' => "required|numeric|unique:galleries,year,{$this->route('gallery')},id,deleted_at,NULL|max:" . date('Y'),
            'gallery' => 'required|array',
            'gallery.*.image' => [
                'required_without:gallery.*.media_id',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
            'gallery.*.video_url' => ['nullable', 'string', 'url', new YouTubeUrl],
            'gallery.*.sort' => 'nullable|numeric|min:0',
            'gallery.*.media_id' => 'nullable|exists:media,id',

        ];
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [
            'gallery.*.image' => "gallery image",
            'gallery.*.video_url' => "gallery video url",
            'gallery.*.sort' => "gallery sort",
            'gallery.*.media_id' => "gallery image",
        ];
    }
}
