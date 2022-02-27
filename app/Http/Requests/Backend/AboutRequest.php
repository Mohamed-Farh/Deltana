<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
                    'main'          => 'required',
                    'work'          => 'required',
                    'performance'   => 'required',
                    'quality'       => 'required',
                    'maintenance'   => 'required',
                    'images'        => 'required',
                    'images.*'      => 'mimes:png,jpg,jpeg,gif|max:4048'
                ];
            }

            case 'PUT':
            {
                return[
                    'main'          => 'required',
                    'work'          => 'required',
                    'performance'   => 'required',
                    'quality'       => 'required',
                    'maintenance'   => 'required',
                    'images'        => 'nullable',
                    'images.*'      => 'mimes:png,jpg,jpeg,gif|max:4048'
                ];
            }

            case 'PATCH':
            {
                return[
                    'main'          => 'required',
                    'work'          => 'required',
                    'performance'   => 'required',
                    'quality'       => 'required',
                    'maintenance'   => 'required',
                    'images'        => 'nullable',
                    'images.*'      => 'mimes:png,jpg,jpeg,gif|max:4048'
                ];
            }

            default: break;
        }

    }
}
