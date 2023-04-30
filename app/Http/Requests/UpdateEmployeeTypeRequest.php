<?php

namespace App\Http\Requests;

use App\Models\EmployeeType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmployeeTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_type_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'institute_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
