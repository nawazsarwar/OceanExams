<?php

namespace App\Http\Requests;

use App\Models\TransportVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransportVehicleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transport_vehicle_edit');
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
