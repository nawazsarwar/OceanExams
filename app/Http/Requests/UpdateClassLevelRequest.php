<?php

namespace App\Http\Requests;

use App\Models\ClassLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClassLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('class_level_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'institute_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
