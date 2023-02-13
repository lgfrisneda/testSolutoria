<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFinancialIndicatorRequest extends FormRequest
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
        $rules = [
            'name'=> 'required',
            'code'=> 'required',
            'unit'=> 'required',
            'value'=> 'required',
            'date'=> 'required',
            'origin'=> 'required'
        ];

        if($this->get('time')){
            $rules = array_merge($rules, ['time'=> 'required']);
        }

        return $rules;
    }
}
