<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransportRouteRequest;
use App\Http\Requests\UpdateTransportRouteRequest;
use App\Http\Resources\Admin\TransportRouteResource;
use App\Models\TransportRoute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransportRoutesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transport_route_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransportRouteResource(TransportRoute::with(['institute'])->get());
    }

    public function store(StoreTransportRouteRequest $request)
    {
        $transportRoute = TransportRoute::create($request->all());

        return (new TransportRouteResource($transportRoute))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransportRoute $transportRoute)
    {
        abort_if(Gate::denies('transport_route_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransportRouteResource($transportRoute->load(['institute']));
    }

    public function update(UpdateTransportRouteRequest $request, TransportRoute $transportRoute)
    {
        $transportRoute->update($request->all());

        return (new TransportRouteResource($transportRoute))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransportRoute $transportRoute)
    {
        abort_if(Gate::denies('transport_route_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportRoute->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
