<?php

namespace App\Http\Requests;

use App\Models\AcademicSession;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAcademicSessionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('academic_session_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:academic_sessions',
            ],
        ];
    }
}
