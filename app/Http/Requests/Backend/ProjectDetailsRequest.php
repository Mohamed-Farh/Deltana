<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProjectDetailsRequest extends FormRequest
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
                    'title'          => 'required',
                    'category'   => 'required',
                    'text'       => 'required',
                    'technology'   => 'required',
                    'video'   => 'nullable',
                    'top'       => 'required',
                    'status'   => 'required',
                    'link'   => 'nullable',
                    'images'        => 'required',
                    'images.*'      => 'mimes:png,jpg,jpeg,gif|max:4048'
                ];
            }

            case 'PUT':
            {
                return[
                    'title'          => 'required',
                    'category'   => 'required',
                    'text'       => 'required',
                    'technology'   => 'required',
                    'video'   => 'nullable',
                    'top'       => 'required',
                    'status'   => 'required',
                    'link'   => 'nullable',
                    'images'        => 'nullable',
                    'images.*'      => 'mimes:png,jpg,jpeg,gif|max:4048'
                ];
            }

            case 'PATCH':
            {
                return[
                    'title'          => 'required',
                    'category'   => 'required',
                    'text'       => 'required',
                    'technology'   => 'required',
                    'video'   => 'nullable',
                    'top'       => 'required',
                    'status'   => 'required',
                    'link'   => 'nullable',
                    'images'        => 'nullable',
                    'images.*'      => 'mimes:png,jpg,jpeg,gif|max:4048'
                ];
            }

            default: break;
        }

    }
}
