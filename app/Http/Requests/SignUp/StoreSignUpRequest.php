<?php

namespace App\Http\Requests\SignUp;

use Illuminate\Foundation\Http\FormRequest;

class StoreSignUpRequest extends FormRequest
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
            'sname'             => 'required|string|min:2',
            'onames'            => 'required|string|min:2',
            'gender'            => 'required',
            'email'             => 'required',
            'phone'             => 'required',
            'marital_status_id' => 'required',
            'dob'               => 'required',
            'country_code'      => 'required',
            'place_of_birth'    => 'required',
            'state_id'          => 'required',
            'lga_id'            => 'required',
            'profile_picture'   => 'required|image|max:1024',

            'nok_name' => 'required',
            'nok_dob' => 'required',
            'nok_gender_id' => 'required',
            'relationship_with_nok' => 'required',
            'nok_address' => 'required',

//        'number_of_plots' => 'required',
            'referrer' => 'required',
            'estate_id' => 'required',
            'propertyType_id' => 'required',
            'payment_plan_id' => 'required',
            'signature' => 'required|image|max:1024',
        ];
    }
}
