<?php

namespace App\Http\Controllers\Frontend;

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

class DesignationsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('designation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designations = Designation::with(['institution'])->get();

        return view('frontend.designations.index', compact('designations'));
    }

    public function create()
    {
        abort_if(Gate::denies('designation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.designations.create', compact('institutions'));
    }

    public function store(StoreDesignationRequest $request)
    {
        $designation = Designation::create($request->all());

        return redirect()->route('frontend.designations.index');
    }

    public function edit(Designation $designation)
    {
        abort_if(Gate::denies('designation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $designation->load('institution');

        return view('frontend.designations.edit', compact('designation', 'institutions'));
    }

    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $designation->update($request->all());

        return redirect()->route('frontend.designations.index');
    }

    public function show(Designation $designation)
    {
        abort_if(Gate::denies('designation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designation->load('institution');

        return view('frontend.designations.show', compact('designation'));
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
