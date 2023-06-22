<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLedgerRequest;
use App\Http\Requests\UpdateLedgerRequest;
use App\Http\Resources\Admin\LedgerResource;
use App\Models\Ledger;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LedgerApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ledger_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LedgerResource(Ledger::with(['student', 'fee_structure', 'institute', 'added_by'])->get());
    }

    public function store(StoreLedgerRequest $request)
    {
        $ledger = Ledger::create($request->all());

        return (new LedgerResource($ledger))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ledger $ledger)
    {
        abort_if(Gate::denies('ledger_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LedgerResource($ledger->load(['student', 'fee_structure', 'institute', 'added_by']));
    }

    public function update(UpdateLedgerRequest $request, Ledger $ledger)
    {
        $ledger->update($request->all());

        return (new LedgerResource($ledger))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ledger $ledger)
    {
        abort_if(Gate::denies('ledger_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ledger->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
