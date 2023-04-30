<?php

namespace App\Http\Controllers\Frontend;

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

class RouteStopsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('route_stop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routeStops = RouteStop::with(['transport_route'])->get();

        return view('frontend.routeStops.index', compact('routeStops'));
    }

    public function create()
    {
        abort_if(Gate::denies('route_stop_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.routeStops.create', compact('transport_routes'));
    }

    public function store(StoreRouteStopRequest $request)
    {
        $routeStop = RouteStop::create($request->all());

        return redirect()->route('frontend.route-stops.index');
    }

    public function edit(RouteStop $routeStop)
    {
        abort_if(Gate::denies('route_stop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $routeStop->load('transport_route');

        return view('frontend.routeStops.edit', compact('routeStop', 'transport_routes'));
    }

    public function update(UpdateRouteStopRequest $request, RouteStop $routeStop)
    {
        $routeStop->update($request->all());

        return redirect()->route('frontend.route-stops.index');
    }

    public function show(RouteStop $routeStop)
    {
        abort_if(Gate::denies('route_stop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routeStop->load('transport_route');

        return view('frontend.routeStops.show', compact('routeStop'));
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
