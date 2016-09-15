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
        $action = $this->route()->getName();

        if (preg_match('/update/',$action)){
            return [
                'name'=>'required|min:3',
                'email'=>'required|email'
            ];
        }else{
            return [
                'name'=>'required|min:3',
                'email'=>'required|email',
                'password'=>'required|min:3' //only in create
            ];
        }
    }
}
