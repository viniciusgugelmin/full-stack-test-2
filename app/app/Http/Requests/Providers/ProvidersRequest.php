<?php

namespace App\Http\Requests\Providers;

use App\Http\Requests\BaseRequest;

class ProvidersRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:rfc,dns|unique:providers,email,NULL,id,deleted_at,NULL'
        ];

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'PATCH':
            case 'PUT':
            case 'POST':
                {
                    return $rules;
                }
            default: break;
        }
        return null;
    }
}
