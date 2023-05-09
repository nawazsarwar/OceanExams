<?php

namespace App\Http\Requests;

use App\Models\FeeStructure;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFeeStructureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fee_structure_create');
    }

    public function rules()
    {
        return [
            'fee_heads.*' => [
                'integer',
            ],
            'fee_heads' => [
                'array',
            ],
        ];
    }
}
