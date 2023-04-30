<?php

namespace App\Http\Requests;

use App\Models\InstituteType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInstituteTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institute_type_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:institute_types,title,' . request()->route('institute_type')->id,
            ],
        ];
    }
}
