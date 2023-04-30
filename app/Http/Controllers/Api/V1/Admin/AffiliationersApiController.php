<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAffiliationerRequest;
use App\Http\Requests\UpdateAffiliationerRequest;
use App\Http\Resources\Admin\AffiliationerResource;
use App\Models\Affiliationer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AffiliationersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('affiliationer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AffiliationerResource(Affiliationer::all());
    }

    public function store(StoreAffiliationerRequest $request)
    {
        $affiliationer = Affiliationer::create($request->all());

        return (new AffiliationerResource($affiliationer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Affiliationer $affiliationer)
    {
        abort_if(Gate::denies('affiliationer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AffiliationerResource($affiliationer);
    }

    public function update(UpdateAffiliationerRequest $request, Affiliationer $affiliationer)
    {
        $affiliationer->update($request->all());

        return (new AffiliationerResource($affiliationer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Affiliationer $affiliationer)
    {
        abort_if(Gate::denies('affiliationer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $affiliationer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
