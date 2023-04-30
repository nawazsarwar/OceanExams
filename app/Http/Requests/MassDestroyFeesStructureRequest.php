<?php

namespace App\Http\Requests;

use App\Models\FeesStructure;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFeesStructureRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fees_structure_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fees_structures,id',
        ];
    }
}
