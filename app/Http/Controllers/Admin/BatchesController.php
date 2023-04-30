<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBatchRequest;
use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;
use App\Models\Batch;
use App\Models\Course;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BatchesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('batch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Batch::with(['course'])->select(sprintf('%s.*', (new Batch)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'batch_show';
                $editGate      = 'batch_edit';
                $deleteGate    = 'batch_delete';
                $crudRoutePart = 'batches';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->addColumn('course_title', function ($row) {
                return $row->course ? $row->course->title : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? Batch::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('timing', function ($row) {
                return $row->timing ? $row->timing : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Batch::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'course']);

            return $table->make(true);
        }

        return view('admin.batches.index');
    }

    public function create()
    {
        abort_if(Gate::denies('batch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.batches.create', compact('courses'));
    }

    public function store(StoreBatchRequest $request)
    {
        $batch = Batch::create($request->all());

        return redirect()->route('admin.batches.index');
    }

    public function edit(Batch $batch)
    {
        abort_if(Gate::denies('batch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batch->load('course');

        return view('admin.batches.edit', compact('batch', 'courses'));
    }

    public function update(UpdateBatchRequest $request, Batch $batch)
    {
        $batch->update($request->all());

        return redirect()->route('admin.batches.index');
    }

    public function show(Batch $batch)
    {
        abort_if(Gate::denies('batch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batch->load('course');

        return view('admin.batches.show', compact('batch'));
    }

    public function destroy(Batch $batch)
    {
        abort_if(Gate::denies('batch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batch->delete();

        return back();
    }

    public function massDestroy(MassDestroyBatchRequest $request)
    {
        $batches = Batch::find(request('ids'));

        foreach ($batches as $batch) {
            $batch->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
