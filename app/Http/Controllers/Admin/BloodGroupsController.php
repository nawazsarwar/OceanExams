<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBloodGroupRequest;
use App\Http\Requests\StoreBloodGroupRequest;
use App\Http\Requests\UpdateBloodGroupRequest;
use App\Models\BloodGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BloodGroupsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('blood_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BloodGroup::query()->select(sprintf('%s.*', (new BloodGroup)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'blood_group_show';
                $editGate      = 'blood_group_edit';
                $deleteGate    = 'blood_group_delete';
                $crudRoutePart = 'blood-groups';

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

        return view('admin.bloodGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('blood_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bloodGroups.create');
    }

    public function store(StoreBloodGroupRequest $request)
    {
        $bloodGroup = BloodGroup::create($request->all());

        return redirect()->route('admin.blood-groups.index');
    }

    public function edit(BloodGroup $bloodGroup)
    {
        abort_if(Gate::denies('blood_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bloodGroups.edit', compact('bloodGroup'));
    }

    public function update(UpdateBloodGroupRequest $request, BloodGroup $bloodGroup)
    {
        $bloodGroup->update($request->all());

        return redirect()->route('admin.blood-groups.index');
    }

    public function show(BloodGroup $bloodGroup)
    {
        abort_if(Gate::denies('blood_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bloodGroups.show', compact('bloodGroup'));
    }

    public function destroy(BloodGroup $bloodGroup)
    {
        abort_if(Gate::denies('blood_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bloodGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyBloodGroupRequest $request)
    {
        $bloodGroups = BloodGroup::find(request('ids'));

        foreach ($bloodGroups as $bloodGroup) {
            $bloodGroup->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
