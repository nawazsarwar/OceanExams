<?php

namespace App\Http\Requests;

use App\Models\Affiliationer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAffiliationerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('affiliationer_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:affiliationers,name,' . request()->route('affiliationer')->id,
            ],
        ];
    }
}
