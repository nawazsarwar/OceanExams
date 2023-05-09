<?php

namespace App\Http\Requests;

use App\Models\MarkAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMarkAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mark_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mark_attendances,id',
        ];
    }
}
