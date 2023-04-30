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
            'prefix' => [
                'string',
                'required',
                'unique:partners,prefix,' . request()->route('partner')->id,
            ],
            'primary_url' => [
                'string',
                'required',
                'unique:partners,primary_url,' . request()->route('partner')->id,
            ],
            'header_background_color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
