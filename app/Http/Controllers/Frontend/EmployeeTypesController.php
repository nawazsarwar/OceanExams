<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEmployeeTypeRequest;
use App\Http\Requests\StoreEmployeeTypeRequest;
use App\Http\Requests\UpdateEmployeeTypeRequest;
use App\Models\EmployeeType;
use App\Models\Institute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeTypesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('employee_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeTypes = EmployeeType::with(['institute', 'institution'])->get();

        return view('frontend.employeeTypes.index', compact('employeeTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('employee_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.employeeTypes.create', compact('institutes', 'institutions'));
    }

    public function store(StoreEmployeeTypeRequest $request)
    {
        $employeeType = EmployeeType::create($request->all());

        return redirect()->route('frontend.employee-types.index');
    }

    public function edit(EmployeeType $employeeType)
    {
        abort_if(Gate::denies('employee_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employeeType->load('institute', 'institution');

        return view('frontend.employeeTypes.edit', compact('employeeType', 'institutes', 'institutions'));
    }

    public function update(UpdateEmployeeTypeRequest $request, EmployeeType $employeeType)
    {
        $employeeType->update($request->all());

        return redirect()->route('frontend.employee-types.index');
    }

    public function show(EmployeeType $employeeType)
    {
        abort_if(Gate::denies('employee_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeType->load('institute', 'institution');

        return view('frontend.employeeTypes.show', compact('employeeType'));
    }

    public function destroy(EmployeeType $employeeType)
    {
        abort_if(Gate::denies('employee_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeType->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeTypeRequest $request)
    {
        $employeeTypes = EmployeeType::find(request('ids'));

        foreach ($employeeTypes as $employeeType) {
            $employeeType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
