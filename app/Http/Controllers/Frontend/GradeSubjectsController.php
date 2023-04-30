<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGradeSubjectRequest;
use App\Http\Requests\StoreGradeSubjectRequest;
use App\Http\Requests\UpdateGradeSubjectRequest;
use App\Models\Grade;
use App\Models\GradeSubject;
use App\Models\Institute;
use App\Models\Subject;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GradeSubjectsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('grade_subject_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gradeSubjects = GradeSubject::with(['grade', 'subject', 'institute'])->get();

        return view('frontend.gradeSubjects.index', compact('gradeSubjects'));
    }

    public function create()
    {
        abort_if(Gate::denies('grade_subject_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grades = Grade::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = Subject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.gradeSubjects.create', compact('grades', 'institutes', 'subjects'));
    }

    public function store(StoreGradeSubjectRequest $request)
    {
        $gradeSubject = GradeSubject::create($request->all());

        return redirect()->route('frontend.grade-subjects.index');
    }

    public function edit(GradeSubject $gradeSubject)
    {
        abort_if(Gate::denies('grade_subject_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grades = Grade::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = Subject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gradeSubject->load('grade', 'subject', 'institute');

        return view('frontend.gradeSubjects.edit', compact('gradeSubject', 'grades', 'institutes', 'subjects'));
    }

    public function update(UpdateGradeSubjectRequest $request, GradeSubject $gradeSubject)
    {
        $gradeSubject->update($request->all());

        return redirect()->route('frontend.grade-subjects.index');
    }

    public function show(GradeSubject $gradeSubject)
    {
        abort_if(Gate::denies('grade_subject_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gradeSubject->load('grade', 'subject', 'institute');

        return view('frontend.gradeSubjects.show', compact('gradeSubject'));
    }

    public function destroy(GradeSubject $gradeSubject)
    {
        abort_if(Gate::denies('grade_subject_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gradeSubject->delete();

        return back();
    }

    public function massDestroy(MassDestroyGradeSubjectRequest $request)
    {
        $gradeSubjects = GradeSubject::find(request('ids'));

        foreach ($gradeSubjects as $gradeSubject) {
            $gradeSubject->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
