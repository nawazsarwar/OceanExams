<?php

namespace App\Http\Requests;

use App\Models\IssueBook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIssueBookRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('issue_book_create');
    }

    public function rules()
    {
        return [
            'book_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'issue_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'return_date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'issued_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
