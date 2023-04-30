<?php

namespace App\Http\Requests;

use App\Models\RouteStop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRouteStopRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('route_stop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:route_stops,id',
        ];
    }
}
