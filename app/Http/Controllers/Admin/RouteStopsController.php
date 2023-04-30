<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRouteStopRequest;
use App\Http\Requests\StoreRouteStopRequest;
use App\Http\Requests\UpdateRouteStopRequest;
use App\Models\RouteStop;
use App\Models\TransportRoute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RouteStopsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('route_stop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RouteStop::with(['transport_route'])->select(sprintf('%s.*', (new RouteStop)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'route_stop_show';
                $editGate      = 'route_stop_edit';
                $deleteGate    = 'route_stop_delete';
                $crudRoutePart = 'route-stops';

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
            $table->addColumn('transport_route_name', function ($row) {
                return $row->transport_route ? $row->transport_route->name : '';
            });

            $table->editColumn('fare', function ($row) {
                return $row->fare ? $row->fare : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'transport_route']);

            return $table->make(true);
        }

        return view('admin.routeStops.index');
    }

    public function create()
    {
        abort_if(Gate::denies('route_stop_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.routeStops.create', compact('transport_routes'));
    }

    public function store(StoreRouteStopRequest $request)
    {
        $routeStop = RouteStop::create($request->all());

        return redirect()->route('admin.route-stops.index');
    }

    public function edit(RouteStop $routeStop)
    {
        abort_if(Gate::denies('route_stop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $routeStop->load('transport_route');

        return view('admin.routeStops.edit', compact('routeStop', 'transport_routes'));
    }

    public function update(UpdateRouteStopRequest $request, RouteStop $routeStop)
    {
        $routeStop->update($request->all());

        return redirect()->route('admin.route-stops.index');
    }

    public function show(RouteStop $routeStop)
    {
        abort_if(Gate::denies('route_stop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routeStop->load('transport_route');

        return view('admin.routeStops.show', compact('routeStop'));
    }

    public function destroy(RouteStop $routeStop)
    {
        abort_if(Gate::denies('route_stop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routeStop->delete();

        return back();
    }

    public function massDestroy(MassDestroyRouteStopRequest $request)
    {
        $routeStops = RouteStop::find(request('ids'));

        foreach ($routeStops as $routeStop) {
            $routeStop->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
