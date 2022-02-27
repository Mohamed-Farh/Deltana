<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
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
                    'location'          => 'required',
                    'type'   => 'required',
                    'exp_year'       => 'required',
                    // 'description'   => 'required',
                    // 'requirements'   => 'required',
                    'image'        => 'required|mimes:png,jpg,jpeg|max:2048'
                ];
            }

            case 'PUT':
            {
                return[
                    'title'          => 'required',
                    'location'          => 'required',
                    'type'   => 'required',
                    'exp_year'       => 'required',
                    'description'   => 'required',
                    'requirements'   => 'required',
                    'image'        => 'nullable|mimes:png,jpg,jpeg|max:2048'
                ];
            }

            case 'PATCH':
            {
                return[
                    'title'          => 'required',
                    'location'          => 'required',
                    'type'   => 'required',
                    'exp_year'       => 'required',
                    'description'   => 'required',
                    'requirements'   => 'required',
                    'image'        => 'nullable|mimes:png,jpg,jpeg|max:2048'
                ];
            }

            default: break;
        }

    }
}
