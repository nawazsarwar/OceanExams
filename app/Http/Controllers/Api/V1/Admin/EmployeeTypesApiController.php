<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeTypeRequest;
use App\Http\Requests\UpdateEmployeeTypeRequest;
use App\Http\Resources\Admin\EmployeeTypeResource;
use App\Models\EmployeeType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employee_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeTypeResource(EmployeeType::with(['institute', 'institution'])->get());
    }

    public function store(StoreEmployeeTypeRequest $request)
    {
        $employeeType = EmployeeType::create($request->all());

        return (new EmployeeTypeResource($employeeType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmployeeType $employeeType)
    {
        abort_if(Gate::denies('employee_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeTypeResource($employeeType->load(['institute', 'institution']));
    }

    public function update(UpdateEmployeeTypeRequest $request, EmployeeType $employeeType)
    {
        $employeeType->update($request->all());

        return (new EmployeeTypeResource($employeeType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmployeeType $employeeType)
    {
        abort_if(Gate::denies('employee_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
