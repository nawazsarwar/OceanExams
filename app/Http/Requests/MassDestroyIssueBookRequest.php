<?php

namespace App\Http\Requests;

use App\Models\IssueBook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIssueBookRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('issue_book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:issue_books,id',
        ];
    }
}
