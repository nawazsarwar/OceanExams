<?php

namespace App\Http\Requests;

use App\Models\Institute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstituteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institute_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:institutes',
            ],
            'subdomain' => [
                'string',
                'required',
                'unique:institutes',
            ],
            'hostname' => [
                'string',
                'nullable',
            ],
            'affiliations.*' => [
                'integer',
            ],
            'affiliations' => [
                'array',
            ],
            'affiliation_no' => [
                'string',
                'nullable',
            ],
            'template' => [
                'string',
                'nullable',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
            'public_mobile' => [
                'string',
                'nullable',
            ],
        ];
    }
}
