<?php

namespace App\Http\Requests;

use App\Models\OmrBasedTest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOmrBasedTestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('omr_based_test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:omr_based_tests,id',
        ];
    }
}
