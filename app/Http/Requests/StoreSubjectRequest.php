<?php

namespace App\Http\Requests;

use App\Models\Subject;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('subject_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'remarks' => [
                'string',
                'nullable',
            ],
            'institute_id' => [
                'required',
                'integer',
            ],
            'sections.*' => [
                'integer',
            ],
            'sections' => [
                'required',
                'array',
            ],
        ];
    }
}
