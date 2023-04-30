<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstituteLevelRequest;
use App\Http\Requests\UpdateInstituteLevelRequest;
use App\Http\Resources\Admin\InstituteLevelResource;
use App\Models\InstituteLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstituteLevelsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('institute_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstituteLevelResource(InstituteLevel::all());
    }

    public function store(StoreInstituteLevelRequest $request)
    {
        $instituteLevel = InstituteLevel::create($request->all());

        return (new InstituteLevelResource($instituteLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InstituteLevel $instituteLevel)
    {
        abort_if(Gate::denies('institute_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstituteLevelResource($instituteLevel);
    }

    public function update(UpdateInstituteLevelRequest $request, InstituteLevel $instituteLevel)
    {
        $instituteLevel->update($request->all());

        return (new InstituteLevelResource($instituteLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InstituteLevel $instituteLevel)
    {
        abort_if(Gate::denies('institute_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
