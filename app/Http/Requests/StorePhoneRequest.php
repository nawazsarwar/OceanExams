<?php

namespace App\Http\Requests;

use App\Models\Phone;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePhoneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('phone_create');
    }

    public function rules()
    {
        return [
            'number' => [
                'string',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'category' => [
                'required',
            ],
            'type' => [
                'required',
            ],
            'dailing_code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
