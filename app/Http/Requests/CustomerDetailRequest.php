<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CustomerDetail;

class CustomerDetailRequest extends FormRequest
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
            'business_name' => 'required|string|max:150',
            'business_address_1' => 'required|string|max:300',
            'business_country_id' => 'required',
            'business_city_id'=> 'required',
            'business_region_id'=> 'required',
            'business_email' => 'required|email|max:150',
            'business_contact_no'  => 'required|numeric|digits:11',
            'user_id'  => 'required',
            'delivery_name' => 'required|string|max:150',
            'delivery_address_1' => 'required|string|max:300',
            'delivery_country_id' => 'required',
            'delivery_city_id'  => 'required',
            'delivery_region_id' => 'required',
        ];
    }
}
