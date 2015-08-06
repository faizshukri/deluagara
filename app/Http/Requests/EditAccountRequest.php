<?php

namespace Katsitu\Http\Requests;

use Katsitu\Http\Requests\Request;

class EditAccountRequest extends Request
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
    public function rules(\Illuminate\Http\Request $request)
    {
        $user = $request->user();

        return [
            'username'              => 'required|min:3|unique:users,username,'.$user->id,
            'email'                 => 'required|email|unique:users,email,'.$user->id,
            'old_password'          => 'current_password|required_with:password',
            'password'              => 'confirmed|min:6|required_with:old_password'
        ];
    }
}
