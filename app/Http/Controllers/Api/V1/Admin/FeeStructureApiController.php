<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeStructureRequest;
use App\Http\Requests\UpdateFeeStructureRequest;
use App\Http\Resources\Admin\FeeStructureResource;
use App\Models\FeeStructure;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeeStructureApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fee_structure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeeStructureResource(FeeStructure::with(['fee_heads', 'institute', 'course'])->get());
    }

    public function store(StoreFeeStructureRequest $request)
    {
        $feeStructure = FeeStructure::create($request->all());
        $feeStructure->fee_heads()->sync($request->input('fee_heads', []));

        return (new FeeStructureResource($feeStructure))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FeeStructure $feeStructure)
    {
        abort_if(Gate::denies('fee_structure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeeStructureResource($feeStructure->load(['fee_heads', 'institute', 'course']));
    }

    public function update(UpdateFeeStructureRequest $request, FeeStructure $feeStructure)
    {
        $feeStructure->update($request->all());
        $feeStructure->fee_heads()->sync($request->input('fee_heads', []));

        return (new FeeStructureResource($feeStructure))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FeeStructure $feeStructure)
    {
        abort_if(Gate::denies('fee_structure_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeStructure->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
