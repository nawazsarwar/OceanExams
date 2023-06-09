<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_create');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
            ],
            'middle_name' => [
                'string',
                'nullable',
            ],
            'last_name' => [
                'string',
                'nullable',
            ],
            'mobile_no' => [
                'string',
                'required',
            ],
            'fathers_name' => [
                'string',
                'nullable',
            ],
            'mothers_name' => [
                'string',
                'nullable',
            ],
            'parents_contact' => [
                'string',
                'nullable',
            ],
            'date_of_birth' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'date_of_joining' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'enrollment_no' => [
                'string',
                'nullable',
            ],
            'roll_no' => [
                'string',
                'nullable',
            ],
            'id_card_no' => [
                'string',
                'nullable',
            ],
            'sections.*' => [
                'integer',
            ],
            'sections' => [
                'required',
                'array',
            ],
            'users.*' => [
                'integer',
            ],
            'users' => [
                'required',
                'array',
            ],
        ];
    }
}
