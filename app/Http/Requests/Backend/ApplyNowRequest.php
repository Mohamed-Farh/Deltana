<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ApplyNowRequest extends FormRequest
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
                    'first_name'    => 'required',
                    'last_name'     => 'required',
                    'email'         => 'required|email|max:255|unique:users',
                    'mobile'        => 'required|numeric|unique:users',
                    'file'          => 'required'
                ];
            }

            case 'PUT':

            case 'PATCH':

            default: break;
        }

    }
}
