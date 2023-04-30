<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFeesStructureRequest;
use App\Http\Requests\StoreFeesStructureRequest;
use App\Http\Requests\UpdateFeesStructureRequest;
use App\Models\Batch;
use App\Models\Course;
use App\Models\FeesStructure;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FeesStructureController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('fees_structure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FeesStructure::with(['course', 'batch'])->select(sprintf('%s.*', (new FeesStructure())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fees_structure_show';
                $editGate = 'fees_structure_edit';
                $deleteGate = 'fees_structure_delete';
                $crudRoutePart = 'fees-structures';

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
            $table->addColumn('course_title', function ($row) {
                return $row->course ? $row->course->title : '';
            });

            $table->addColumn('batch_title', function ($row) {
                return $row->batch ? $row->batch->title : '';
            });

            $table->editColumn('fee', function ($row) {
                return $row->fee ? $row->fee : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'course', 'batch']);

            return $table->make(true);
        }

        return view('admin.feesStructures.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fees_structure_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.feesStructures.create', compact('batches', 'courses'));
    }

    public function store(StoreFeesStructureRequest $request)
    {
        $feesStructure = FeesStructure::create($request->all());

        return redirect()->route('admin.fees-structures.index');
    }

    public function edit(FeesStructure $feesStructure)
    {
        abort_if(Gate::denies('fees_structure_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feesStructure->load('course', 'batch');

        return view('admin.feesStructures.edit', compact('batches', 'courses', 'feesStructure'));
    }

    public function update(UpdateFeesStructureRequest $request, FeesStructure $feesStructure)
    {
        $feesStructure->update($request->all());

        return redirect()->route('admin.fees-structures.index');
    }

    public function show(FeesStructure $feesStructure)
    {
        abort_if(Gate::denies('fees_structure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feesStructure->load('course', 'batch');

        return view('admin.feesStructures.show', compact('feesStructure'));
    }

    public function destroy(FeesStructure $feesStructure)
    {
        abort_if(Gate::denies('fees_structure_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feesStructure->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeesStructureRequest $request)
    {
        $feesStructures = FeesStructure::find(request('ids'));

        foreach ($feesStructures as $feesStructure) {
            $feesStructure->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
