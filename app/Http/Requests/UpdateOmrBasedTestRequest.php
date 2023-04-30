<?php

namespace App\Http\Requests;

use App\Models\OmrBasedTest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOmrBasedTestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('omr_based_test_edit');
    }

    public function rules()
    {
        return [
            'series' => [
                'string',
                'required',
            ],
            'type' => [
                'string',
                'required',
            ],
            'negative_mark' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'correct_mark' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'total_question' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'target_year' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'test_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
