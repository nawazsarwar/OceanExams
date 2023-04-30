<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeesStructureRequest;
use App\Http\Requests\UpdateFeesStructureRequest;
use App\Http\Resources\Admin\FeesStructureResource;
use App\Models\FeesStructure;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeesStructureApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fees_structure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeesStructureResource(FeesStructure::with(['course', 'batch'])->get());
    }

    public function store(StoreFeesStructureRequest $request)
    {
        $feesStructure = FeesStructure::create($request->all());

        return (new FeesStructureResource($feesStructure))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FeesStructure $feesStructure)
    {
        abort_if(Gate::denies('fees_structure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeesStructureResource($feesStructure->load(['course', 'batch']));
    }

    public function update(UpdateFeesStructureRequest $request, FeesStructure $feesStructure)
    {
        $feesStructure->update($request->all());

        return (new FeesStructureResource($feesStructure))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FeesStructure $feesStructure)
    {
        abort_if(Gate::denies('fees_structure_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feesStructure->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
