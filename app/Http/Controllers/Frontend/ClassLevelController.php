<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClassLevelRequest;
use App\Http\Requests\StoreClassLevelRequest;
use App\Http\Requests\UpdateClassLevelRequest;
use App\Models\ClassLevel;
use App\Models\Institute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClassLevelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('class_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classLevels = ClassLevel::with(['institute'])->get();

        return view('frontend.classLevels.index', compact('classLevels'));
    }

    public function create()
    {
        abort_if(Gate::denies('class_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.classLevels.create', compact('institutes'));
    }

    public function store(StoreClassLevelRequest $request)
    {
        $classLevel = ClassLevel::create($request->all());

        return redirect()->route('frontend.class-levels.index');
    }

    public function edit(ClassLevel $classLevel)
    {
        abort_if(Gate::denies('class_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classLevel->load('institute');

        return view('frontend.classLevels.edit', compact('classLevel', 'institutes'));
    }

    public function update(UpdateClassLevelRequest $request, ClassLevel $classLevel)
    {
        $classLevel->update($request->all());

        return redirect()->route('frontend.class-levels.index');
    }

    public function show(ClassLevel $classLevel)
    {
        abort_if(Gate::denies('class_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classLevel->load('institute');

        return view('frontend.classLevels.show', compact('classLevel'));
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
