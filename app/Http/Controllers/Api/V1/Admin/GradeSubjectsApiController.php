<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeSubjectRequest;
use App\Http\Requests\UpdateGradeSubjectRequest;
use App\Http\Resources\Admin\GradeSubjectResource;
use App\Models\GradeSubject;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GradeSubjectsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('grade_subject_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GradeSubjectResource(GradeSubject::with(['grade', 'subject', 'institute'])->get());
    }

    public function store(StoreGradeSubjectRequest $request)
    {
        $gradeSubject = GradeSubject::create($request->all());

        return (new GradeSubjectResource($gradeSubject))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GradeSubject $gradeSubject)
    {
        abort_if(Gate::denies('grade_subject_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GradeSubjectResource($gradeSubject->load(['grade', 'subject', 'institute']));
    }

    public function update(UpdateGradeSubjectRequest $request, GradeSubject $gradeSubject)
    {
        $gradeSubject->update($request->all());

        return (new GradeSubjectResource($gradeSubject))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GradeSubject $gradeSubject)
    {
        abort_if(Gate::denies('grade_subject_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gradeSubject->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
