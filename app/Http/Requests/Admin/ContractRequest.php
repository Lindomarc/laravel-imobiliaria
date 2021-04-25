<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
            'owner_id' => 'required',
            'acquirer' => 'required|different:owner_id',
            'sale_price' => 'required_if:sale:on',
            'rent_price' => 'required_if:rent:on',
            'property' => 'required|integer',
            'due_date' => 'required|integer|min:1|max:28',
            'deadine' => 'required|integer|min:12|max:48',
            'start_at' => 'required'
        ];
    }
}
