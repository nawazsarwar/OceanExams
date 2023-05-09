<?php

namespace App\Http\Controllers\Frontend;

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

class MarkAttendanceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mark_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $markAttendances = MarkAttendance::with(['institute', 'section', 'user'])->get();

        return view('frontend.markAttendances.index', compact('markAttendances'));
    }

    public function create()
    {
        abort_if(Gate::denies('mark_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sections = Section::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.markAttendances.create', compact('institutes', 'sections', 'users'));
    }

    public function store(StoreMarkAttendanceRequest $request)
    {
        $markAttendance = MarkAttendance::create($request->all());

        return redirect()->route('frontend.mark-attendances.index');
    }

    public function edit(MarkAttendance $markAttendance)
    {
        abort_if(Gate::denies('mark_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sections = Section::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $markAttendance->load('institute', 'section', 'user');

        return view('frontend.markAttendances.edit', compact('institutes', 'markAttendance', 'sections', 'users'));
    }

    public function update(UpdateMarkAttendanceRequest $request, MarkAttendance $markAttendance)
    {
        $markAttendance->update($request->all());

        return redirect()->route('frontend.mark-attendances.index');
    }

    public function show(MarkAttendance $markAttendance)
    {
        abort_if(Gate::denies('mark_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $markAttendance->load('institute', 'section', 'user');

        return view('frontend.markAttendances.show', compact('markAttendance'));
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
