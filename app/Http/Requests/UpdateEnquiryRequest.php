<?php

namespace App\Http\Requests;

use App\Models\Enquiry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('enquiry_edit');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
            ],
            'middle_name' => [
                'string',
                'nullable',
            ],
            'last_name' => [
                'string',
                'nullable',
            ],
            'fathers_name' => [
                'string',
                'nullable',
            ],
            'mothers_name' => [
                'string',
                'nullable',
            ],
            'mobile_no' => [
                'string',
                'required',
            ],
            'course_id' => [
                'required',
                'integer',
            ],
            'passing_year' => [
                'string',
                'required',
            ],
            'message' => [
                'required',
            ],
        ];
    }
}
