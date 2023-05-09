<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'contact' => [
                'string',
                'required',
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'subjects.*' => [
                'integer',
            ],
            'subjects' => [
                'array',
            ],
            'designation_id' => [
                'required',
                'integer',
            ],
            'employee_type_id' => [
                'required',
                'integer',
            ],
            'institution_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
