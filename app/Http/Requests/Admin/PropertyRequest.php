<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'category' => 'required',
            'type' => 'required',
            'sale_price' => 'required_if:sale,on',
            'rend_price' => 'required_if:rend,on',
            'tribute' => 'required',
            'condominium' => 'required',

            'description' => 'required',
            'bedrooms' => 'required',
            'suites' => 'required',
            'bathrooms' => 'required',
            'garage' => 'required',
            'garage_covered' => 'required',
            'area_total' => 'required',
            'area_util' => 'required',
            // Address
            'zipcode' => 'required|min:8|max:9',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
            'city' => 'required',

            // Structure
            'title' => 'required'

        ];
    }
}
