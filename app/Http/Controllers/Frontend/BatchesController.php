<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBatchRequest;
use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;
use App\Models\Batch;
use App\Models\Course;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BatchesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('batch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::with(['course'])->get();

        return view('frontend.batches.index', compact('batches'));
    }

    public function create()
    {
        abort_if(Gate::denies('batch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.batches.create', compact('courses'));
    }

    public function store(StoreBatchRequest $request)
    {
        $batch = Batch::create($request->all());

        return redirect()->route('frontend.batches.index');
    }

    public function edit(Batch $batch)
    {
        abort_if(Gate::denies('batch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batch->load('course');

        return view('frontend.batches.edit', compact('batch', 'courses'));
    }

    public function update(UpdateBatchRequest $request, Batch $batch)
    {
        $batch->update($request->all());

        return redirect()->route('frontend.batches.index');
    }

    public function show(Batch $batch)
    {
        abort_if(Gate::denies('batch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batch->load('course');

        return view('frontend.batches.show', compact('batch'));
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
