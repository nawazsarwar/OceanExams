<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInstituteLevelRequest;
use App\Http\Requests\StoreInstituteLevelRequest;
use App\Http\Requests\UpdateInstituteLevelRequest;
use App\Models\InstituteLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstituteLevelsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('institute_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteLevels = InstituteLevel::all();

        return view('frontend.instituteLevels.index', compact('instituteLevels'));
    }

    public function create()
    {
        abort_if(Gate::denies('institute_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.instituteLevels.create');
    }

    public function store(StoreInstituteLevelRequest $request)
    {
        $instituteLevel = InstituteLevel::create($request->all());

        return redirect()->route('frontend.institute-levels.index');
    }

    public function edit(InstituteLevel $instituteLevel)
    {
        abort_if(Gate::denies('institute_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.instituteLevels.edit', compact('instituteLevel'));
    }

    public function update(UpdateInstituteLevelRequest $request, InstituteLevel $instituteLevel)
    {
        $instituteLevel->update($request->all());

        return redirect()->route('frontend.institute-levels.index');
    }

    public function show(InstituteLevel $instituteLevel)
    {
        abort_if(Gate::denies('institute_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.instituteLevels.show', compact('instituteLevel'));
    }

    public function destroy(InstituteLevel $instituteLevel)
    {
        abort_if(Gate::denies('institute_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstituteLevelRequest $request)
    {
        $instituteLevels = InstituteLevel::find(request('ids'));

        foreach ($instituteLevels as $instituteLevel) {
            $instituteLevel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
