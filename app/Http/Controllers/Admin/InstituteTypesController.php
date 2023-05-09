<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInstituteTypeRequest;
use App\Http\Requests\StoreInstituteTypeRequest;
use App\Http\Requests\UpdateInstituteTypeRequest;
use App\Models\InstituteType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InstituteTypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('institute_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InstituteType::query()->select(sprintf('%s.*', (new InstituteType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'institute_type_show';
                $editGate      = 'institute_type_edit';
                $deleteGate    = 'institute_type_delete';
                $crudRoutePart = 'institute-types';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.instituteTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('institute_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instituteTypes.create');
    }

    public function store(StoreInstituteTypeRequest $request)
    {
        $instituteType = InstituteType::create($request->all());

        return redirect()->route('admin.institute-types.index');
    }

    public function edit(InstituteType $instituteType)
    {
        abort_if(Gate::denies('institute_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instituteTypes.edit', compact('instituteType'));
    }

    public function update(UpdateInstituteTypeRequest $request, InstituteType $instituteType)
    {
        $instituteType->update($request->all());

        return redirect()->route('admin.institute-types.index');
    }

    public function show(InstituteType $instituteType)
    {
        abort_if(Gate::denies('institute_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instituteTypes.show', compact('instituteType'));
    }

    public function destroy(InstituteType $instituteType)
    {
        abort_if(Gate::denies('institute_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteType->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstituteTypeRequest $request)
    {
        $instituteTypes = InstituteType::find(request('ids'));

        foreach ($instituteTypes as $instituteType) {
            $instituteType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
