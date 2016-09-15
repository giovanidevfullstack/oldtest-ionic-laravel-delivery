<?php

namespace Delivery\Http\Requests;

use Delivery\Http\Requests\Request;

class AdminClientRequest extends Request
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
            'name'=>'required|min:3',
            'email'=>'required|email',
           // 'password'=>'required|min:3', //only in create
            'phone'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zipcode'=>'required'
        ];
    }
}
