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
            'prefix' => [
                'string',
                'required',
                'unique:partners',
            ],
            'primary_url' => [
                'string',
                'required',
                'unique:partners',
            ],
            'header_background_color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
