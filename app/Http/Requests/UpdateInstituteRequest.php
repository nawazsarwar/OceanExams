<?php

namespace App\Http\Requests;

use App\Models\Institute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInstituteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institute_edit');
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
                'unique:institutes,email,' . request()->route('institute')->id,
            ],
            'subdomain' => [
                'string',
                'required',
                'unique:institutes,subdomain,' . request()->route('institute')->id,
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
