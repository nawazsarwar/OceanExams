<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInstituteTypeRequest;
use App\Http\Requests\StoreInstituteTypeRequest;
use App\Http\Requests\UpdateInstituteTypeRequest;
use App\Models\InstituteType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstituteTypesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('institute_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteTypes = InstituteType::all();

        return view('frontend.instituteTypes.index', compact('instituteTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('institute_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.instituteTypes.create');
    }

    public function store(StoreInstituteTypeRequest $request)
    {
        $instituteType = InstituteType::create($request->all());

        return redirect()->route('frontend.institute-types.index');
    }

    public function edit(InstituteType $instituteType)
    {
        abort_if(Gate::denies('institute_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.instituteTypes.edit', compact('instituteType'));
    }

    public function update(UpdateInstituteTypeRequest $request, InstituteType $instituteType)
    {
        $instituteType->update($request->all());

        return redirect()->route('frontend.institute-types.index');
    }

    public function show(InstituteType $instituteType)
    {
        abort_if(Gate::denies('institute_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.instituteTypes.show', compact('instituteType'));
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
