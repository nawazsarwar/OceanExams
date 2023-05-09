<?php

namespace App\Http\Requests;

use App\Models\Partner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePartnerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('partner_create');
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
                'unique:partners',
            ],
            'subdomain' => [
                'string',
                'required',
                'unique:partners',
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
