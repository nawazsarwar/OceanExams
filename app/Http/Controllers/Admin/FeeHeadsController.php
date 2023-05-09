<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FeeHeadsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('fee_head_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FeeHead::with(['institute'])->select(sprintf('%s.*', (new FeeHead)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'fee_head_show';
                $editGate      = 'fee_head_edit';
                $deleteGate    = 'fee_head_delete';
                $crudRoutePart = 'fee-heads';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? FeeHead::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('recurrence', function ($row) {
                return $row->recurrence ? $row->recurrence : '';
            });
            $table->addColumn('institute_name', function ($row) {
                return $row->institute ? $row->institute->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'institute']);

            return $table->make(true);
        }

        return view('admin.feeHeads.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fee_head_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.feeHeads.create', compact('institutes'));
    }

    public function store(StoreFeeHeadRequest $request)
    {
        $feeHead = FeeHead::create($request->all());

        return redirect()->route('admin.fee-heads.index');
    }

    public function edit(FeeHead $feeHead)
    {
        abort_if(Gate::denies('fee_head_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeHead->load('institute');

        return view('admin.feeHeads.edit', compact('feeHead', 'institutes'));
    }

    public function update(UpdateFeeHeadRequest $request, FeeHead $feeHead)
    {
        $feeHead->update($request->all());

        return redirect()->route('admin.fee-heads.index');
    }

    public function show(FeeHead $feeHead)
    {
        abort_if(Gate::denies('fee_head_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeHead->load('institute');

        return view('admin.feeHeads.show', compact('feeHead'));
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
