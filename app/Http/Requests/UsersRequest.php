<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
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
        switch ($this->method()) {
            case 'GET': {
                return [];
            }
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'username' => 'required|unique:users,username|min:3|max:45',
                    'name' => 'required|min:3|max:45',
                    'email' => 'required|email|unique:users,email|max:300',
                    'password' => 'required|between:6,16',
                    'password_confirmation' => 'required|same:password',
                    'permission' => 'required',
                    'companies' => 'required_if:permission,3'
                ];
            }
            case 'PUT': {
                return [
                    'username' => 'required|unique:users,username,'.$this->users.'|min:3|max:45',
                    'name' => 'required|min:3|max:45',
                    'email' => 'required|email|unique:users,email,'.$this->users.'|max:300',
                    'password' => 'between:6,16',
                    'password_confirmation' => 'same:password',
                    'permission' => 'required',
                    'companies' => 'required_if:permission,3'
                ];
            }
            case 'PATCH': {
                return [];
            }
            default: {
                return [];
            }
        }
        return [];
    }
}
