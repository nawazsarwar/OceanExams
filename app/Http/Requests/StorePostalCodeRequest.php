<?php

namespace App\Http\Requests;

use App\Models\PostalCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostalCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('postal_code_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'locality' => [
                'string',
                'nullable',
            ],
            'code' => [
                'string',
                'required',
            ],
            'sub_district' => [
                'string',
                'nullable',
            ],
            'district' => [
                'string',
                'required',
            ],
        ];
    }
}
