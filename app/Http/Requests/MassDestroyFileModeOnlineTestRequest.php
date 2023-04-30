<?php

namespace App\Http\Requests;

use App\Models\FileModeOnlineTest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFileModeOnlineTestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('file_mode_online_test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:file_mode_online_tests,id',
        ];
    }
}
