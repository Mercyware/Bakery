<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            //
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|max:15',
            'account_number' => 'required|max:15',
            'description' => 'required|max:5000',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Supplier Name is required!',
            'email.required' => 'Supplier Email is required!',
            'phone.required' => 'Supplier Phone Number is required',
            'description.required' => 'Supplier Description is required',
            'account_number.required' => 'Supplier Account Number is required',

        ];
    }
}
