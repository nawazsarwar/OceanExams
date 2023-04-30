<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransportVehicleRequest;
use App\Http\Requests\StoreTransportVehicleRequest;
use App\Http\Requests\UpdateTransportVehicleRequest;
use App\Models\Employee;
use App\Models\TransportVehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransportVehiclesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transport_vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportVehicles = TransportVehicle::with(['driver', 'assistant'])->get();

        return view('frontend.transportVehicles.index', compact('transportVehicles'));
    }

    public function create()
    {
        abort_if(Gate::denies('transport_vehicle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assistants = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.transportVehicles.create', compact('assistants', 'drivers'));
    }

    public function store(StoreTransportVehicleRequest $request)
    {
        $transportVehicle = TransportVehicle::create($request->all());

        return redirect()->route('frontend.transport-vehicles.index');
    }

    public function edit(TransportVehicle $transportVehicle)
    {
        abort_if(Gate::denies('transport_vehicle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assistants = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transportVehicle->load('driver', 'assistant');

        return view('frontend.transportVehicles.edit', compact('assistants', 'drivers', 'transportVehicle'));
    }

    public function update(UpdateTransportVehicleRequest $request, TransportVehicle $transportVehicle)
    {
        $transportVehicle->update($request->all());

        return redirect()->route('frontend.transport-vehicles.index');
    }

    public function show(TransportVehicle $transportVehicle)
    {
        abort_if(Gate::denies('transport_vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportVehicle->load('driver', 'assistant');

        return view('frontend.transportVehicles.show', compact('transportVehicle'));
    }

    public function destroy(TransportVehicle $transportVehicle)
    {
        abort_if(Gate::denies('transport_vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportVehicle->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransportVehicleRequest $request)
    {
        $transportVehicles = TransportVehicle::find(request('ids'));

        foreach ($transportVehicles as $transportVehicle) {
            $transportVehicle->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
