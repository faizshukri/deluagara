<?php

namespace Katsitu\Http\Requests;

use Katsitu\Http\Requests\Request;

class ForgotPasswordRequest extends Request
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
            'email' => 'required|email|exists:users,email'
        ];
    }

    public function messages()
    {
        return [
            'exists' => 'The email entered is not exists'
        ];
    }
}
