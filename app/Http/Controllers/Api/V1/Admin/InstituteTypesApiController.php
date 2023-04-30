<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstituteTypeRequest;
use App\Http\Requests\UpdateInstituteTypeRequest;
use App\Http\Resources\Admin\InstituteTypeResource;
use App\Models\InstituteType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstituteTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('institute_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstituteTypeResource(InstituteType::all());
    }

    public function store(StoreInstituteTypeRequest $request)
    {
        $instituteType = InstituteType::create($request->all());

        return (new InstituteTypeResource($instituteType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InstituteType $instituteType)
    {
        abort_if(Gate::denies('institute_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstituteTypeResource($instituteType);
    }

    public function update(UpdateInstituteTypeRequest $request, InstituteType $instituteType)
    {
        $instituteType->update($request->all());

        return (new InstituteTypeResource($instituteType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InstituteType $instituteType)
    {
        abort_if(Gate::denies('institute_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
