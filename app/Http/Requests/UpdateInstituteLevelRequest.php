<?php

namespace App\Http\Requests;

use App\Models\InstituteLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInstituteLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institute_level_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:institute_levels,name,' . request()->route('institute_level')->id,
            ],
        ];
    }
}
