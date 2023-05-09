<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class EmployeeTypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('employee_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EmployeeType::with(['institute', 'institution'])->select(sprintf('%s.*', (new EmployeeType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'employee_type_show';
                $editGate      = 'employee_type_edit';
                $deleteGate    = 'employee_type_delete';
                $crudRoutePart = 'employee-types';

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

            $table->addColumn('institution_name', function ($row) {
                return $row->institution ? $row->institution->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'institute', 'institution']);

            return $table->make(true);
        }

        return view('admin.employeeTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('employee_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employeeTypes.create', compact('institutes', 'institutions'));
    }

    public function store(StoreEmployeeTypeRequest $request)
    {
        $employeeType = EmployeeType::create($request->all());

        return redirect()->route('admin.employee-types.index');
    }

    public function edit(EmployeeType $employeeType)
    {
        abort_if(Gate::denies('employee_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employeeType->load('institute', 'institution');

        return view('admin.employeeTypes.edit', compact('employeeType', 'institutes', 'institutions'));
    }

    public function update(UpdateEmployeeTypeRequest $request, EmployeeType $employeeType)
    {
        $employeeType->update($request->all());

        return redirect()->route('admin.employee-types.index');
    }

    public function show(EmployeeType $employeeType)
    {
        abort_if(Gate::denies('employee_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeType->load('institute', 'institution');

        return view('admin.employeeTypes.show', compact('employeeType'));
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
