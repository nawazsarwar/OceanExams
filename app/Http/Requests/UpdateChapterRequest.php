<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateChapterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('chapter_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'grade_subject_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
