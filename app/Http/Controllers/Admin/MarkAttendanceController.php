<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMarkAttendanceRequest;
use App\Http\Requests\StoreMarkAttendanceRequest;
use App\Http\Requests\UpdateMarkAttendanceRequest;
use App\Models\Institute;
use App\Models\MarkAttendance;
use App\Models\Section;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MarkAttendanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('mark_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MarkAttendance::with(['institute', 'section', 'user'])->select(sprintf('%s.*', (new MarkAttendance)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mark_attendance_show';
                $editGate      = 'mark_attendance_edit';
                $deleteGate    = 'mark_attendance_delete';
                $crudRoutePart = 'mark-attendances';

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
            $table->addColumn('institute_name', function ($row) {
                return $row->institute ? $row->institute->name : '';
            });

            $table->addColumn('section_title', function ($row) {
                return $row->section ? $row->section->title : '';
            });

            $table->editColumn('students', function ($row) {
                return $row->students ? $row->students : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'institute', 'section', 'user']);

            return $table->make(true);
        }

        return view('admin.markAttendances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mark_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sections = Section::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.markAttendances.create', compact('institutes', 'sections', 'users'));
    }

    public function store(StoreMarkAttendanceRequest $request)
    {
        $markAttendance = MarkAttendance::create($request->all());

        return redirect()->route('admin.mark-attendances.index');
    }

    public function edit(MarkAttendance $markAttendance)
    {
        abort_if(Gate::denies('mark_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sections = Section::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $markAttendance->load('institute', 'section', 'user');

        return view('admin.markAttendances.edit', compact('institutes', 'markAttendance', 'sections', 'users'));
    }

    public function update(UpdateMarkAttendanceRequest $request, MarkAttendance $markAttendance)
    {
        $markAttendance->update($request->all());

        return redirect()->route('admin.mark-attendances.index');
    }

    public function show(MarkAttendance $markAttendance)
    {
        abort_if(Gate::denies('mark_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $markAttendance->load('institute', 'section', 'user');

        return view('admin.markAttendances.show', compact('markAttendance'));
    }

    public function destroy(MarkAttendance $markAttendance)
    {
        abort_if(Gate::denies('mark_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $markAttendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyMarkAttendanceRequest $request)
    {
        $markAttendances = MarkAttendance::find(request('ids'));

        foreach ($markAttendances as $markAttendance) {
            $markAttendance->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
