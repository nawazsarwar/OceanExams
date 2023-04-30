<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInstituteLevelRequest;
use App\Http\Requests\StoreInstituteLevelRequest;
use App\Http\Requests\UpdateInstituteLevelRequest;
use App\Models\InstituteLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InstituteLevelsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('institute_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InstituteLevel::query()->select(sprintf('%s.*', (new InstituteLevel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'institute_level_show';
                $editGate = 'institute_level_edit';
                $deleteGate = 'institute_level_delete';
                $crudRoutePart = 'institute-levels';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.instituteLevels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('institute_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instituteLevels.create');
    }

    public function store(StoreInstituteLevelRequest $request)
    {
        $instituteLevel = InstituteLevel::create($request->all());

        return redirect()->route('admin.institute-levels.index');
    }

    public function edit(InstituteLevel $instituteLevel)
    {
        abort_if(Gate::denies('institute_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instituteLevels.edit', compact('instituteLevel'));
    }

    public function update(UpdateInstituteLevelRequest $request, InstituteLevel $instituteLevel)
    {
        $instituteLevel->update($request->all());

        return redirect()->route('admin.institute-levels.index');
    }

    public function show(InstituteLevel $instituteLevel)
    {
        abort_if(Gate::denies('institute_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instituteLevels.show', compact('instituteLevel'));
    }

    public function destroy(InstituteLevel $instituteLevel)
    {
        abort_if(Gate::denies('institute_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstituteLevelRequest $request)
    {
        InstituteLevel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
