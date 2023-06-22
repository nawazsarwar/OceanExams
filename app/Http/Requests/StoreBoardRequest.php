<?php

namespace App\Http\Requests;

use App\Models\Board;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBoardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('board_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
