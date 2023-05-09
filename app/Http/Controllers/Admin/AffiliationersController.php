<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAffiliationerRequest;
use App\Http\Requests\StoreAffiliationerRequest;
use App\Http\Requests\UpdateAffiliationerRequest;
use App\Models\Affiliationer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AffiliationersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('affiliationer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Affiliationer::query()->select(sprintf('%s.*', (new Affiliationer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'affiliationer_show';
                $editGate      = 'affiliationer_edit';
                $deleteGate    = 'affiliationer_delete';
                $crudRoutePart = 'affiliationers';

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

        return view('admin.affiliationers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('affiliationer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.affiliationers.create');
    }

    public function store(StoreAffiliationerRequest $request)
    {
        $affiliationer = Affiliationer::create($request->all());

        return redirect()->route('admin.affiliationers.index');
    }

    public function edit(Affiliationer $affiliationer)
    {
        abort_if(Gate::denies('affiliationer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.affiliationers.edit', compact('affiliationer'));
    }

    public function update(UpdateAffiliationerRequest $request, Affiliationer $affiliationer)
    {
        $affiliationer->update($request->all());

        return redirect()->route('admin.affiliationers.index');
    }

    public function show(Affiliationer $affiliationer)
    {
        abort_if(Gate::denies('affiliationer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.affiliationers.show', compact('affiliationer'));
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
