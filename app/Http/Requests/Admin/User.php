<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class User extends FormRequest
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

    public function all($keys= null)
    {
        return $this->validateFields(parent::all());
    }
    public function validateFields(array $inputs)
    {
        $inputs['document'] = onlyNumber($this->request->all()['document']);
        return $inputs;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*
         * se id existe é edição
         */
        $isEdit =(isset($this->request->all()['id'])) ?(','.$this->request->all()['id']) : '';

        return [
            'name' => 'required|min:3|max:191',
            'genre' => 'in:m,f',
            'document' => 'required|digits_between:11,14|unique:users,document'.$isEdit,
            'document_secondary' => 'required|min:8|max:12',
            'document_secondary_complement' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',

            'civil_status' => 'required|in:1,2,3,4,5',

            // Income
            'occupation' => 'required',
            'income' => 'required',
            'company_work' => 'required',

            // Address
            'zipcode' => 'required|min:8|max:9',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
            'city' => 'required',

            // Contact
            'cell' => 'required',

            // Access
            'email' => 'required|email|unique:users,email'.$isEdit,

            // Spouse
            // 1= Comunhão Universal de Bens, 2= Comunhão Parcial de Bens, 3= Separação Total de Bens, 4=Participação Final de Aquestos
            'type_of_communion' => 'required_if:civil_status,1,2|in:1,2,3,4',
            'spouse_name' => 'required_if:civil_status,1,2|min:3|max:191',
            'spouse_genre' => 'required_if:civil_status,1,2|in:m,f',
            'spouse_document' => 'required_if:civil_status,1,2|min:11|max:14',
            'spouse_document_secondary' => 'required_if:civil_status,1,2|min:8|max:12',
            'spouse_document_secondary_complement' => 'required_if:civil_status,1,2',
            'spouse_date_of_birth' => 'required_if:civil_status,1,2',
            'spouse_place_of_birth' => 'required_if:civil_status,1,2',
            'spouse_occupation' => 'required_if:civil_status,1,2',
            'spouse_income' => 'required_if:civil_status,1,2',
            'spouse_company_work' => 'required_if:civil_status,1,2',
            //
        ];
    }


}
