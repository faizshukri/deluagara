<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

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
//        dd($request->input());
        $user = $request->user();
        return [
            'name' => 'required',
            'username' => 'required|min:3|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'gender' => 'required',
            'status' => 'required',
            'sponsor' => 'required',
            'location.address' => 'required',
            'location.postcode' => 'required|max:10',
            'location.city.id' => 'required',
            'website' => 'required',
            'facebook_url' => 'required',
            'twitter_url' => 'required'
        ];
    }
}
