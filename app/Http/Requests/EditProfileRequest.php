<?php

namespace Katsitu\Http\Requests;

use Katsitu\Http\Requests\Request;

class EditProfileRequest extends Request
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
            'name' => 'required',
            'about_me' => 'min:20',
            'gender' => 'required',
            'end_date' => 'date|after:-1year|before:+15years',
            'location.street' => 'required_with:location.postcode,location.city.id',
            'location.postcode' => 'required_with:location.street,location.city.id',
            'location.city.id' => 'required_with:location.postcode,location.street',
            'profile_image' => 'image|max:5120',
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
