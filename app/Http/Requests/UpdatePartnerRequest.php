<?php

namespace App\Http\Requests;

use App\Models\Partner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePartnerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('partner_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'product_name' => [
                'string',
                'required',
                'unique:partners,product_name,' . request()->route('partner')->id,
            ],
            'subdomain' => [
                'string',
                'required',
                'unique:partners,subdomain,' . request()->route('partner')->id,
            ],
            'hostname' => [
                'string',
                'required',
            ],
            'public_mobile' => [
                'string',
                'nullable',
            ],
            'header_background_color' => [
                'string',
                'nullable',
            ],
            'footer_background_color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
