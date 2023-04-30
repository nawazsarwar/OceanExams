<?php

namespace App\Http\Controllers\Frontend;

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

class FeesStructureController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fees_structure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feesStructures = FeesStructure::with(['course', 'batch'])->get();

        return view('frontend.feesStructures.index', compact('feesStructures'));
    }

    public function create()
    {
        abort_if(Gate::denies('fees_structure_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.feesStructures.create', compact('batches', 'courses'));
    }

    public function store(StoreFeesStructureRequest $request)
    {
        $feesStructure = FeesStructure::create($request->all());

        return redirect()->route('frontend.fees-structures.index');
    }

    public function edit(FeesStructure $feesStructure)
    {
        abort_if(Gate::denies('fees_structure_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feesStructure->load('course', 'batch');

        return view('frontend.feesStructures.edit', compact('batches', 'courses', 'feesStructure'));
    }

    public function update(UpdateFeesStructureRequest $request, FeesStructure $feesStructure)
    {
        $feesStructure->update($request->all());

        return redirect()->route('frontend.fees-structures.index');
    }

    public function show(FeesStructure $feesStructure)
    {
        abort_if(Gate::denies('fees_structure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feesStructure->load('course', 'batch');

        return view('frontend.feesStructures.show', compact('feesStructure'));
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
