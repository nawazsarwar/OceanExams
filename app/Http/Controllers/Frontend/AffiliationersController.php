<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAffiliationerRequest;
use App\Http\Requests\StoreAffiliationerRequest;
use App\Http\Requests\UpdateAffiliationerRequest;
use App\Models\Affiliationer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AffiliationersController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('affiliationer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $affiliationers = Affiliationer::all();

        return view('frontend.affiliationers.index', compact('affiliationers'));
    }

    public function create()
    {
        abort_if(Gate::denies('affiliationer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.affiliationers.create');
    }

    public function store(StoreAffiliationerRequest $request)
    {
        $affiliationer = Affiliationer::create($request->all());

        return redirect()->route('frontend.affiliationers.index');
    }

    public function edit(Affiliationer $affiliationer)
    {
        abort_if(Gate::denies('affiliationer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.affiliationers.edit', compact('affiliationer'));
    }

    public function update(UpdateAffiliationerRequest $request, Affiliationer $affiliationer)
    {
        $affiliationer->update($request->all());

        return redirect()->route('frontend.affiliationers.index');
    }

    public function show(Affiliationer $affiliationer)
    {
        abort_if(Gate::denies('affiliationer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.affiliationers.show', compact('affiliationer'));
    }

    public function destroy(Affiliationer $affiliationer)
    {
        abort_if(Gate::denies('affiliationer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $affiliationer->delete();

        return back();
    }

    public function massDestroy(MassDestroyAffiliationerRequest $request)
    {
        $affiliationers = Affiliationer::find(request('ids'));

        foreach ($affiliationers as $affiliationer) {
            $affiliationer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
