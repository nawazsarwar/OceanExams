<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTransportRouteRequest;
use App\Http\Requests\StoreTransportRouteRequest;
use App\Http\Requests\UpdateTransportRouteRequest;
use App\Models\Institute;
use App\Models\TransportRoute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransportRoutesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('transport_route_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TransportRoute::with(['institute'])->select(sprintf('%s.*', (new TransportRoute)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'transport_route_show';
                $editGate      = 'transport_route_edit';
                $deleteGate    = 'transport_route_delete';
                $crudRoutePart = 'transport-routes';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('institute_name', function ($row) {
                return $row->institute ? $row->institute->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'institute']);

            return $table->make(true);
        }

        return view('admin.transportRoutes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transport_route_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transportRoutes.create', compact('institutes'));
    }

    public function store(StoreTransportRouteRequest $request)
    {
        $transportRoute = TransportRoute::create($request->all());

        return redirect()->route('admin.transport-routes.index');
    }

    public function edit(TransportRoute $transportRoute)
    {
        abort_if(Gate::denies('transport_route_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transportRoute->load('institute');

        return view('admin.transportRoutes.edit', compact('institutes', 'transportRoute'));
    }

    public function update(UpdateTransportRouteRequest $request, TransportRoute $transportRoute)
    {
        $transportRoute->update($request->all());

        return redirect()->route('admin.transport-routes.index');
    }

    public function show(TransportRoute $transportRoute)
    {
        abort_if(Gate::denies('transport_route_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportRoute->load('institute');

        return view('admin.transportRoutes.show', compact('transportRoute'));
    }

    public function destroy(TransportRoute $transportRoute)
    {
        abort_if(Gate::denies('transport_route_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportRoute->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransportRouteRequest $request)
    {
        $transportRoutes = TransportRoute::find(request('ids'));

        foreach ($transportRoutes as $transportRoute) {
            $transportRoute->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
