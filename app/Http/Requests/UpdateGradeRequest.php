<?php

namespace App\Http\Requests;

use App\Models\Grade;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGradeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('grade_edit');
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
