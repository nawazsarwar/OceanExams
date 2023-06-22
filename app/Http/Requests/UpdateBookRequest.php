<?php

namespace App\Http\Requests;

use App\Models\Book;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('book_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'author' => [
                'string',
                'nullable',
            ],
            'edition' => [
                'string',
                'nullable',
            ],
            'publisher' => [
                'string',
                'nullable',
            ],
            'isbn' => [
                'string',
                'nullable',
            ],
            'copies' => [
                'string',
                'nullable',
            ],
            'price' => [
                'string',
                'nullable',
            ],
            'added_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
