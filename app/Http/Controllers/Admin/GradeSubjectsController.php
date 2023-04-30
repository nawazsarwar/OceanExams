<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class GradeSubjectsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('grade_subject_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GradeSubject::with(['grade', 'subject', 'institute'])->select(sprintf('%s.*', (new GradeSubject)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'grade_subject_show';
                $editGate      = 'grade_subject_edit';
                $deleteGate    = 'grade_subject_delete';
                $crudRoutePart = 'grade-subjects';

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
            $table->addColumn('grade_title', function ($row) {
                return $row->grade ? $row->grade->title : '';
            });

            $table->addColumn('subject_name', function ($row) {
                return $row->subject ? $row->subject->name : '';
            });

            $table->addColumn('institute_name', function ($row) {
                return $row->institute ? $row->institute->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'grade', 'subject', 'institute']);

            return $table->make(true);
        }

        return view('admin.gradeSubjects.index');
    }

    public function create()
    {
        abort_if(Gate::denies('grade_subject_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grades = Grade::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = Subject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.gradeSubjects.create', compact('grades', 'institutes', 'subjects'));
    }

    public function store(StoreGradeSubjectRequest $request)
    {
        $gradeSubject = GradeSubject::create($request->all());

        return redirect()->route('admin.grade-subjects.index');
    }

    public function edit(GradeSubject $gradeSubject)
    {
        abort_if(Gate::denies('grade_subject_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grades = Grade::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = Subject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gradeSubject->load('grade', 'subject', 'institute');

        return view('admin.gradeSubjects.edit', compact('gradeSubject', 'grades', 'institutes', 'subjects'));
    }

    public function update(UpdateGradeSubjectRequest $request, GradeSubject $gradeSubject)
    {
        $gradeSubject->update($request->all());

        return redirect()->route('admin.grade-subjects.index');
    }

    public function show(GradeSubject $gradeSubject)
    {
        abort_if(Gate::denies('grade_subject_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gradeSubject->load('grade', 'subject', 'institute');

        return view('admin.gradeSubjects.show', compact('gradeSubject'));
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
