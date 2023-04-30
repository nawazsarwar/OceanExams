<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransportVehicleRequest;
use App\Http\Requests\UpdateTransportVehicleRequest;
use App\Http\Resources\Admin\TransportVehicleResource;
use App\Models\TransportVehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransportVehiclesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transport_vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransportVehicleResource(TransportVehicle::with(['driver', 'assistant'])->get());
    }

    public function store(StoreTransportVehicleRequest $request)
    {
        $transportVehicle = TransportVehicle::create($request->all());

        return (new TransportVehicleResource($transportVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransportVehicle $transportVehicle)
    {
        abort_if(Gate::denies('transport_vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransportVehicleResource($transportVehicle->load(['driver', 'assistant']));
    }

    public function update(UpdateTransportVehicleRequest $request, TransportVehicle $transportVehicle)
    {
        $transportVehicle->update($request->all());

        return (new TransportVehicleResource($transportVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransportVehicle $transportVehicle)
    {
        abort_if(Gate::denies('transport_vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportVehicle->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
