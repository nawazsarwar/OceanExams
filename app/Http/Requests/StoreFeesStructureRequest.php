<?php

namespace App\Http\Requests;

use App\Models\FeesStructure;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFeesStructureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fees_structure_create');
    }

    public function rules()
    {
        return [
            'course_id' => [
                'required',
                'integer',
            ],
            'batch_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
