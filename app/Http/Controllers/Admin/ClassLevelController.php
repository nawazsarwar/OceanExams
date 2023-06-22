<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClassLevelRequest;
use App\Http\Requests\StoreClassLevelRequest;
use App\Http\Requests\UpdateClassLevelRequest;
use App\Models\ClassLevel;
use App\Models\Institute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClassLevelController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('class_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClassLevel::with(['institute'])->select(sprintf('%s.*', (new ClassLevel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'class_level_show';
                $editGate      = 'class_level_edit';
                $deleteGate    = 'class_level_delete';
                $crudRoutePart = 'class-levels';

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

            $table->rawColumns(['actions', 'placeholder', 'institute']);

            return $table->make(true);
        }

        return view('admin.classLevels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('class_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.classLevels.create', compact('institutes'));
    }

    public function store(StoreClassLevelRequest $request)
    {
        $classLevel = ClassLevel::create($request->all());

        return redirect()->route('admin.class-levels.index');
    }

    public function edit(ClassLevel $classLevel)
    {
        abort_if(Gate::denies('class_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classLevel->load('institute');

        return view('admin.classLevels.edit', compact('classLevel', 'institutes'));
    }

    public function update(UpdateClassLevelRequest $request, ClassLevel $classLevel)
    {
        $classLevel->update($request->all());

        return redirect()->route('admin.class-levels.index');
    }

    public function show(ClassLevel $classLevel)
    {
        abort_if(Gate::denies('class_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classLevel->load('institute');

        return view('admin.classLevels.show', compact('classLevel'));
    }

    public function destroy(ClassLevel $classLevel)
    {
        abort_if(Gate::denies('class_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyClassLevelRequest $request)
    {
        $classLevels = ClassLevel::find(request('ids'));

        foreach ($classLevels as $classLevel) {
            $classLevel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
