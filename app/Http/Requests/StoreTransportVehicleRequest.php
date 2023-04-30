<?php

namespace App\Http\Requests;

use App\Models\TransportVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransportVehicleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transport_vehicle_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'driver_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
