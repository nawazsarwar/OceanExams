<?php

namespace App\Http\Requests;

use App\Models\Batch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBatchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('batch_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'target_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'course_id' => [
                'required',
                'integer',
            ],
            'timing' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
