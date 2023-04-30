<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRouteStopRequest;
use App\Http\Requests\UpdateRouteStopRequest;
use App\Http\Resources\Admin\RouteStopResource;
use App\Models\RouteStop;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RouteStopsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('route_stop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RouteStopResource(RouteStop::with(['transport_route'])->get());
    }

    public function store(StoreRouteStopRequest $request)
    {
        $routeStop = RouteStop::create($request->all());

        return (new RouteStopResource($routeStop))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RouteStop $routeStop)
    {
        abort_if(Gate::denies('route_stop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RouteStopResource($routeStop->load(['transport_route']));
    }

    public function update(UpdateRouteStopRequest $request, RouteStop $routeStop)
    {
        $routeStop->update($request->all());

        return (new RouteStopResource($routeStop))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RouteStop $routeStop)
    {
        abort_if(Gate::denies('route_stop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routeStop->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
