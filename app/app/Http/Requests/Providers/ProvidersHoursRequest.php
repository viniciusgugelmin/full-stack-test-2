<?php

namespace App\Http\Requests\Providers;

use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

class ProvidersHoursRequest extends BaseRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'date' => $this->input('date') ? Carbon::parse($this->input('date')) : null,
            'value' => $this->input('value') ? (int)$this->input('value') : null
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'value' => 'required|gte:1|lte:8',
            'period' => 'required|in:morning,afternoon,night',
            'date' => 'required|date'
        ];

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'PATCH':
            case 'PUT':
            case 'POST':
            {
                $rules = array_merge($rules, [
                    'email' => 'required|email:rfc,dns'
                ]);

                return $rules;
            }
            default:
                break;
        }
        return null;
    }
}
