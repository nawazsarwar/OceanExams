<?php

namespace App\Http\Requests;

use App\Models\GradeSubject;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGradeSubjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('grade_subject_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'grade_id' => [
                'required',
                'integer',
            ],
            'subject_id' => [
                'required',
                'integer',
            ],
            'institute_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
