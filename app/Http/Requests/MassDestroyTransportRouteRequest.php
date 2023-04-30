<?php

namespace App\Http\Requests;

use App\Models\TransportRoute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTransportRouteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transport_route_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:transport_routes,id',
        ];
    }
}
