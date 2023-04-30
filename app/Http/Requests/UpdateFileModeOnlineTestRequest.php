<?php

namespace App\Http\Requests;

use App\Models\FileModeOnlineTest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFileModeOnlineTestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('file_mode_online_test_edit');
    }

    public function rules()
    {
        return [
            'quiz' => [
                'string',
                'required',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'test_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
