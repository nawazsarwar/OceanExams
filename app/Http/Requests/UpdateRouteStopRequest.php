<?php

namespace App\Http\Requests;

use App\Models\RouteStop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRouteStopRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('route_stop_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'transport_route_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
