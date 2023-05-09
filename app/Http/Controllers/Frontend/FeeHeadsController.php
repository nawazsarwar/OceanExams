<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFeeHeadRequest;
use App\Http\Requests\StoreFeeHeadRequest;
use App\Http\Requests\UpdateFeeHeadRequest;
use App\Models\FeeHead;
use App\Models\Institute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeeHeadsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('fee_head_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeHeads = FeeHead::with(['institute'])->get();

        return view('frontend.feeHeads.index', compact('feeHeads'));
    }

    public function create()
    {
        abort_if(Gate::denies('fee_head_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.feeHeads.create', compact('institutes'));
    }

    public function store(StoreFeeHeadRequest $request)
    {
        $feeHead = FeeHead::create($request->all());

        return redirect()->route('frontend.fee-heads.index');
    }

    public function edit(FeeHead $feeHead)
    {
        abort_if(Gate::denies('fee_head_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeHead->load('institute');

        return view('frontend.feeHeads.edit', compact('feeHead', 'institutes'));
    }

    public function update(UpdateFeeHeadRequest $request, FeeHead $feeHead)
    {
        $feeHead->update($request->all());

        return redirect()->route('frontend.fee-heads.index');
    }

    public function show(FeeHead $feeHead)
    {
        abort_if(Gate::denies('fee_head_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeHead->load('institute');

        return view('frontend.feeHeads.show', compact('feeHead'));
    }

    public function destroy(FeeHead $feeHead)
    {
        abort_if(Gate::denies('fee_head_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeHead->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeeHeadRequest $request)
    {
        $feeHeads = FeeHead::find(request('ids'));

        foreach ($feeHeads as $feeHead) {
            $feeHead->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
