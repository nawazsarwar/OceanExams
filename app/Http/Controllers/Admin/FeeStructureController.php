<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFeeStructureRequest;
use App\Http\Requests\StoreFeeStructureRequest;
use App\Http\Requests\UpdateFeeStructureRequest;
use App\Models\Course;
use App\Models\FeeHead;
use App\Models\FeeStructure;
use App\Models\Institute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FeeStructureController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('fee_structure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FeeStructure::with(['fee_heads', 'institute', 'course'])->select(sprintf('%s.*', (new FeeStructure)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'fee_structure_show';
                $editGate      = 'fee_structure_edit';
                $deleteGate    = 'fee_structure_delete';
                $crudRoutePart = 'fee-structures';

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
            $table->editColumn('fee_head', function ($row) {
                $labels = [];
                foreach ($row->fee_heads as $fee_head) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $fee_head->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('fee', function ($row) {
                return $row->fee ? $row->fee : '';
            });
            $table->addColumn('institute_name', function ($row) {
                return $row->institute ? $row->institute->name : '';
            });

            $table->addColumn('course_title', function ($row) {
                return $row->course ? $row->course->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fee_head', 'institute', 'course']);

            return $table->make(true);
        }

        return view('admin.feeStructures.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fee_structure_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fee_heads = FeeHead::pluck('name', 'id');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.feeStructures.create', compact('courses', 'fee_heads', 'institutes'));
    }

    public function store(StoreFeeStructureRequest $request)
    {
        $feeStructure = FeeStructure::create($request->all());
        $feeStructure->fee_heads()->sync($request->input('fee_heads', []));

        return redirect()->route('admin.fee-structures.index');
    }

    public function edit(FeeStructure $feeStructure)
    {
        abort_if(Gate::denies('fee_structure_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fee_heads = FeeHead::pluck('name', 'id');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeStructure->load('fee_heads', 'institute', 'course');

        return view('admin.feeStructures.edit', compact('courses', 'feeStructure', 'fee_heads', 'institutes'));
    }

    public function update(UpdateFeeStructureRequest $request, FeeStructure $feeStructure)
    {
        $feeStructure->update($request->all());
        $feeStructure->fee_heads()->sync($request->input('fee_heads', []));

        return redirect()->route('admin.fee-structures.index');
    }

    public function show(FeeStructure $feeStructure)
    {
        abort_if(Gate::denies('fee_structure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeStructure->load('fee_heads', 'institute', 'course');

        return view('admin.feeStructures.show', compact('feeStructure'));
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
