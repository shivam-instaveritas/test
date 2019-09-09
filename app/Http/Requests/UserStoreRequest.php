<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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


    public function message()
    {
        return [
            'name.required'     => 'name is required',
            'age.required'      => 'age is required',
            'email.required'    => 'email is required',
            'username.required' => 'username is required',

            'name.max'          => 'name lenght limit is 50',

            'email.email'       => 'write correct email',
            'email.unique'      => 'email already taken',

            'username.unique'   => 'uername already taken'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required | max:50',
            'age'       => 'required',
            'email'     => 'required | email | unique:users',
            'username'  => 'required | unique:users'
        ];
    }
}
