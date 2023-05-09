<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChapterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('chapter_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
