<?php

namespace App\Http\Requests;

use App\Models\MarkAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMarkAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mark_attendance_edit');
    }

    public function rules()
    {
        return [
            'institute_id' => [
                'required',
                'integer',
            ],
            'section_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
