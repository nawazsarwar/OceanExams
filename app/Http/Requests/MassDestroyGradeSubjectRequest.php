<?php

namespace App\Http\Requests;

use App\Models\GradeSubject;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGradeSubjectRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('grade_subject_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:grade_subjects,id',
        ];
    }
}
