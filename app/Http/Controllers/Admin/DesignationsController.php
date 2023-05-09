<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDesignationRequest;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Models\Designation;
use App\Models\Institute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DesignationsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('designation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Designation::with(['institution'])->select(sprintf('%s.*', (new Designation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'designation_show';
                $editGate      = 'designation_edit';
                $deleteGate    = 'designation_delete';
                $crudRoutePart = 'designations';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('pay_grade', function ($row) {
                return $row->pay_grade ? $row->pay_grade : '';
            });
            $table->addColumn('institution_name', function ($row) {
                return $row->institution ? $row->institution->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'institution']);

            return $table->make(true);
        }

        return view('admin.designations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('designation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.designations.create', compact('institutions'));
    }

    public function store(StoreDesignationRequest $request)
    {
        $designation = Designation::create($request->all());

        return redirect()->route('admin.designations.index');
    }

    public function edit(Designation $designation)
    {
        abort_if(Gate::denies('designation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $designation->load('institution');

        return view('admin.designations.edit', compact('designation', 'institutions'));
    }

    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $designation->update($request->all());

        return redirect()->route('admin.designations.index');
    }

    public function show(Designation $designation)
    {
        abort_if(Gate::denies('designation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designation->load('institution');

        return view('admin.designations.show', compact('designation'));
    }

    public function destroy(Designation $designation)
    {
        abort_if(Gate::denies('designation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designation->delete();

        return back();
    }

    public function massDestroy(MassDestroyDesignationRequest $request)
    {
        $designations = Designation::find(request('ids'));

        foreach ($designations as $designation) {
            $designation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
