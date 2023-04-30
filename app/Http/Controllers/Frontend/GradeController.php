<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGradeRequest;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Grade;
use App\Models\Institute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GradeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('grade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grades = Grade::with(['institute'])->get();

        return view('frontend.grades.index', compact('grades'));
    }

    public function create()
    {
        abort_if(Gate::denies('grade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.grades.create', compact('institutes'));
    }

    public function store(StoreGradeRequest $request)
    {
        $grade = Grade::create($request->all());

        return redirect()->route('frontend.grades.index');
    }

    public function edit(Grade $grade)
    {
        abort_if(Gate::denies('grade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $grade->load('institute');

        return view('frontend.grades.edit', compact('grade', 'institutes'));
    }

    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        $grade->update($request->all());

        return redirect()->route('frontend.grades.index');
    }

    public function show(Grade $grade)
    {
        abort_if(Gate::denies('grade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grade->load('institute');

        return view('frontend.grades.show', compact('grade'));
    }

    public function destroy(Grade $grade)
    {
        abort_if(Gate::denies('grade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grade->delete();

        return back();
    }

    public function massDestroy(MassDestroyGradeRequest $request)
    {
        $grades = Grade::find(request('ids'));

        foreach ($grades as $grade) {
            $grade->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
