<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFeeStructureRequest;
use App\Http\Requests\StoreFeeStructureRequest;
use App\Http\Requests\UpdateFeeStructureRequest;
use App\Models\FeeHead;
use App\Models\FeeStructure;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeeStructureController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fee_structure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeStructures = FeeStructure::with(['fee_heads'])->get();

        return view('frontend.feeStructures.index', compact('feeStructures'));
    }

    public function create()
    {
        abort_if(Gate::denies('fee_structure_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fee_heads = FeeHead::pluck('name', 'id');

        return view('frontend.feeStructures.create', compact('fee_heads'));
    }

    public function store(StoreFeeStructureRequest $request)
    {
        $feeStructure = FeeStructure::create($request->all());
        $feeStructure->fee_heads()->sync($request->input('fee_heads', []));

        return redirect()->route('frontend.fee-structures.index');
    }

    public function edit(FeeStructure $feeStructure)
    {
        abort_if(Gate::denies('fee_structure_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fee_heads = FeeHead::pluck('name', 'id');

        $feeStructure->load('fee_heads');

        return view('frontend.feeStructures.edit', compact('feeStructure', 'fee_heads'));
    }

    public function update(UpdateFeeStructureRequest $request, FeeStructure $feeStructure)
    {
        $feeStructure->update($request->all());
        $feeStructure->fee_heads()->sync($request->input('fee_heads', []));

        return redirect()->route('frontend.fee-structures.index');
    }

    public function show(FeeStructure $feeStructure)
    {
        abort_if(Gate::denies('fee_structure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeStructure->load('fee_heads');

        return view('frontend.feeStructures.show', compact('feeStructure'));
    }

    public function destroy(FeeStructure $feeStructure)
    {
        abort_if(Gate::denies('fee_structure_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeStructure->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeeStructureRequest $request)
    {
        $feeStructures = FeeStructure::find(request('ids'));

        foreach ($feeStructures as $feeStructure) {
            $feeStructure->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
