<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_edit');
    }

    public function rules()
    {
        return [
            'student_id' => [
                'required',
                'integer',
            ],
            'fee_structure_id' => [
                'required',
                'integer',
            ],
            'institute_id' => [
                'required',
                'integer',
            ],
            'payable' => [
                'required',
            ],
            'discount' => [
                'required',
            ],
            'paid' => [
                'required',
            ],
            'balance' => [
                'required',
            ],
            'due_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'payment_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'added_by_id' => [
                'required',
                'integer',
            ],
            'payment_cycle' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
