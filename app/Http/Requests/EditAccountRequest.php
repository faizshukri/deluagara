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
//        dd($request->input());
        $user = $request->user();
        return [
            'name' => 'required',
            'username' => 'required|min:3|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
//            'phone' => 'required',
            'about_me' => 'min:20',
            'gender' => 'required',
//            'status' => 'required',
//            'sponsor' => 'required',
            'location.street' => 'required_with:location.postcode,location.city.id',
            'location.postcode' => 'required_with:location.street,location.city.id',
            'location.city.id' => 'required_with:location.postcode,location.street',
            'profile_image' => 'image|max:5120',
//            'location.postcode' => 'required|max:10',
//            'location.city.id' => 'required',
//            'website' => 'required',
//            'facebook_url' => 'required',
//            'twitter_url' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'location.street.required_with' => 'Street field is required when Postcode / City is present',
            'location.postcode.required_with' => 'Postcode field is required when Street / City is present',
            'location.city.id.required_with' => 'City field is required when Street / Postcode is present',
            'profile_image.max' => 'The profile image muss be less than 5MB',
        ];
    }
}
