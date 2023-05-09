<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeHeadRequest;
use App\Http\Requests\UpdateFeeHeadRequest;
use App\Http\Resources\Admin\FeeHeadResource;
use App\Models\FeeHead;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeeHeadsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fee_head_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeeHeadResource(FeeHead::with(['institute'])->get());
    }

    public function store(StoreFeeHeadRequest $request)
    {
        $feeHead = FeeHead::create($request->all());

        return (new FeeHeadResource($feeHead))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FeeHead $feeHead)
    {
        abort_if(Gate::denies('fee_head_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeeHeadResource($feeHead->load(['institute']));
    }

    public function update(UpdateFeeHeadRequest $request, FeeHead $feeHead)
    {
        $feeHead->update($request->all());

        return (new FeeHeadResource($feeHead))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FeeHead $feeHead)
    {
        abort_if(Gate::denies('fee_head_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeHead->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
