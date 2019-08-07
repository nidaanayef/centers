<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            "employee_name" => "required|string",
            "employee_identity" => "required|numeric|digits:10|unique:employees,employee_identity,".request()->segment(3),
            "mobile" => "required|unique:employees,mobile,".request()->segment(3),
            "email" => "required|email|unique:employees,email,".request()->segment(3),
        ];
    }
}