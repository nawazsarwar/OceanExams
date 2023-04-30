<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class GradeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('grade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Grade::with(['institute'])->select(sprintf('%s.*', (new Grade)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'grade_show';
                $editGate      = 'grade_edit';
                $deleteGate    = 'grade_delete';
                $crudRoutePart = 'grades';

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
            $table->addColumn('institute_name', function ($row) {
                return $row->institute ? $row->institute->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'institute']);

            return $table->make(true);
        }

        return view('admin.grades.index');
    }

    public function create()
    {
        abort_if(Gate::denies('grade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.grades.create', compact('institutes'));
    }

    public function store(StoreGradeRequest $request)
    {
        $grade = Grade::create($request->all());

        return redirect()->route('admin.grades.index');
    }

    public function edit(Grade $grade)
    {
        abort_if(Gate::denies('grade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $grade->load('institute');

        return view('admin.grades.edit', compact('grade', 'institutes'));
    }

    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        $grade->update($request->all());

        return redirect()->route('admin.grades.index');
    }

    public function show(Grade $grade)
    {
        abort_if(Gate::denies('grade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grade->load('institute');

        return view('admin.grades.show', compact('grade'));
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
