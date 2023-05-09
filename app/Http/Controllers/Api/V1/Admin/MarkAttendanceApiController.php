<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMarkAttendanceRequest;
use App\Http\Requests\UpdateMarkAttendanceRequest;
use App\Http\Resources\Admin\MarkAttendanceResource;
use App\Models\MarkAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkAttendanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mark_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarkAttendanceResource(MarkAttendance::with(['institute', 'section', 'user'])->get());
    }

    public function store(StoreMarkAttendanceRequest $request)
    {
        $markAttendance = MarkAttendance::create($request->all());

        return (new MarkAttendanceResource($markAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MarkAttendance $markAttendance)
    {
        abort_if(Gate::denies('mark_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarkAttendanceResource($markAttendance->load(['institute', 'section', 'user']));
    }

    public function update(UpdateMarkAttendanceRequest $request, MarkAttendance $markAttendance)
    {
        $markAttendance->update($request->all());

        return (new MarkAttendanceResource($markAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MarkAttendance $markAttendance)
    {
        abort_if(Gate::denies('mark_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $markAttendance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
