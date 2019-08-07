<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CenterRequest extends FormRequest
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
            'center_name'=>'required|string|unique:centers,center_name,'.request()->segment(3),
            'address'=>'required|max:191',
            'maximum_nomination'=>'required|numeric',
        ];
    }
}