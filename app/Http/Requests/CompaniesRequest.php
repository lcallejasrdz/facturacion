<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompaniesRequest extends Request
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
                    'name' => 'required|min:3|max:250|unique:companies,name',
                    'disperser' => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'name' => 'required|min:3|max:250|unique:companies,name,'.$this->companies,
                    'disperser' => 'required'
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
