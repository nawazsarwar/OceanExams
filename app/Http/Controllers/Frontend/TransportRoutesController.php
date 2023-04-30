<?php

namespace App\Http\Controllers\Frontend;

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

class TransportRoutesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('transport_route_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportRoutes = TransportRoute::with(['institute'])->get();

        return view('frontend.transportRoutes.index', compact('transportRoutes'));
    }

    public function create()
    {
        abort_if(Gate::denies('transport_route_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.transportRoutes.create', compact('institutes'));
    }

    public function store(StoreTransportRouteRequest $request)
    {
        $transportRoute = TransportRoute::create($request->all());

        return redirect()->route('frontend.transport-routes.index');
    }

    public function edit(TransportRoute $transportRoute)
    {
        abort_if(Gate::denies('transport_route_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transportRoute->load('institute');

        return view('frontend.transportRoutes.edit', compact('institutes', 'transportRoute'));
    }

    public function update(UpdateTransportRouteRequest $request, TransportRoute $transportRoute)
    {
        $transportRoute->update($request->all());

        return redirect()->route('frontend.transport-routes.index');
    }

    public function show(TransportRoute $transportRoute)
    {
        abort_if(Gate::denies('transport_route_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportRoute->load('institute');

        return view('frontend.transportRoutes.show', compact('transportRoute'));
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
