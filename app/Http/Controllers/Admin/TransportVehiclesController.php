<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransportVehicleRequest;
use App\Http\Requests\StoreTransportVehicleRequest;
use App\Http\Requests\UpdateTransportVehicleRequest;
use App\Models\Employee;
use App\Models\TransportVehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransportVehiclesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('transport_vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TransportVehicle::with(['driver', 'assistant'])->select(sprintf('%s.*', (new TransportVehicle)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'transport_vehicle_show';
                $editGate      = 'transport_vehicle_edit';
                $deleteGate    = 'transport_vehicle_delete';
                $crudRoutePart = 'transport-vehicles';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->addColumn('driver_name', function ($row) {
                return $row->driver ? $row->driver->name : '';
            });

            $table->addColumn('assistant_name', function ($row) {
                return $row->assistant ? $row->assistant->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'driver', 'assistant']);

            return $table->make(true);
        }

        return view('admin.transportVehicles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transport_vehicle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assistants = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transportVehicles.create', compact('assistants', 'drivers'));
    }

    public function store(StoreTransportVehicleRequest $request)
    {
        $transportVehicle = TransportVehicle::create($request->all());

        return redirect()->route('admin.transport-vehicles.index');
    }

    public function edit(TransportVehicle $transportVehicle)
    {
        abort_if(Gate::denies('transport_vehicle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assistants = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transportVehicle->load('driver', 'assistant');

        return view('admin.transportVehicles.edit', compact('assistants', 'drivers', 'transportVehicle'));
    }

    public function update(UpdateTransportVehicleRequest $request, TransportVehicle $transportVehicle)
    {
        $transportVehicle->update($request->all());

        return redirect()->route('admin.transport-vehicles.index');
    }

    public function show(TransportVehicle $transportVehicle)
    {
        abort_if(Gate::denies('transport_vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportVehicle->load('driver', 'assistant');

        return view('admin.transportVehicles.show', compact('transportVehicle'));
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
