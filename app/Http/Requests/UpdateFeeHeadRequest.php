<?php

namespace App\Http\Requests;

use App\Models\FeeHead;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFeeHeadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fee_head_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'institute_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
