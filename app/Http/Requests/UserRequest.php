<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => "required|string|unique:users,name,".request()->segment(3),
            "password" => "required",
            "email" => "required|email|unique:users,email,".request()->segment(3),
            "manager_identity" => "required|numeric|digits:10|unique:users,manager_identity,".request()->segment(3),
            "mobile" => "required|unique:users,mobile,".request()->segment(3),
        ];
    }
}
