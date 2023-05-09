<?php

namespace App\Http\Requests;

use App\Models\AcademicSession;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAcademicSessionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('academic_session_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:academic_sessions,name,' . request()->route('academic_session')->id,
            ],
            'position' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
