<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySubjectRequest;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Institute;
use App\Models\Subject;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubjectsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Subject::with(['institute'])->select(sprintf('%s.*', (new Subject)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'subject_show';
                $editGate      = 'subject_edit';
                $deleteGate    = 'subject_delete';
                $crudRoutePart = 'subjects';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? Subject::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });
            $table->addColumn('institute_name', function ($row) {
                return $row->institute ? $row->institute->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'institute']);

            return $table->make(true);
        }

        return view('admin.subjects.index');
    }

    public function create()
    {
        abort_if(Gate::denies('subject_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subjects.create', compact('institutes'));
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = Subject::create($request->all());

        return redirect()->route('admin.subjects.index');
    }

    public function edit(Subject $subject)
    {
        abort_if(Gate::denies('subject_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subject->load('institute');

        return view('admin.subjects.edit', compact('institutes', 'subject'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->all());

        return redirect()->route('admin.subjects.index');
    }

    public function show(Subject $subject)
    {
        abort_if(Gate::denies('subject_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subject->load('institute');

        return view('admin.subjects.show', compact('subject'));
    }

    public function destroy(Subject $subject)
    {
        abort_if(Gate::denies('subject_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subject->delete();

        return back();
    }

    public function massDestroy(MassDestroySubjectRequest $request)
    {
        $subjects = Subject::find(request('ids'));

        foreach ($subjects as $subject) {
            $subject->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
