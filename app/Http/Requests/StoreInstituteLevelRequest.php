<?php

namespace App\Http\Requests;

use App\Models\InstituteLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstituteLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institute_level_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:institute_levels',
            ],
        ];
    }
}
