<?php

namespace App\Http\Requests;

use App\Models\Question;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQuestionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('question_create');
    }

    public function rules()
    {
        return [
            'institute_id' => [
                'required',
                'integer',
            ],
            'chapter_id' => [
                'required',
                'integer',
            ],
            'paper' => [
                'string',
                'nullable',
            ],
            'question_no' => [
                'string',
                'nullable',
            ],
            'description' => [
                'required',
            ],
            'type' => [
                'required',
            ],
            'no_of_options' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'created_by_id' => [
                'required',
                'integer',
            ],
            'verified_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
