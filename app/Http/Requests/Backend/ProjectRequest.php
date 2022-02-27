<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        switch ($this->method()){
            case 'POST':
            {
                return[
                    'title'     => 'nullable',
                    'text'      => 'nullable',
                    'button'    => 'nullable',
                    'video_url' => 'nullable|url',
                    'video_src' => 'nullable|url',
                    'image'     => 'nullable|mimes:png,jpg,jpeg|max:2048'
                ];
            }

            case 'PUT':

            case 'PATCH':
            {
                return[
                    'title'     => 'nullable',
                    'text'      => 'nullable',
                    'button'    => 'nullable',
                    'video_url' => 'nullable|url',
                    'video_src' => 'nullable|url',
                    'image'     => 'nullable|mimes:png,jpg,jpeg|max:2048'
                ];
            }

            default: break;
        }

    }
}
