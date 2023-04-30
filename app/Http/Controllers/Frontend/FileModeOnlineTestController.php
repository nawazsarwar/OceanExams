<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFileModeOnlineTestRequest;
use App\Http\Requests\StoreFileModeOnlineTestRequest;
use App\Http\Requests\UpdateFileModeOnlineTestRequest;
use App\Models\FileModeOnlineTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileModeOnlineTestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('file_mode_online_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fileModeOnlineTests = FileModeOnlineTest::all();

        return view('frontend.fileModeOnlineTests.index', compact('fileModeOnlineTests'));
    }

    public function create()
    {
        abort_if(Gate::denies('file_mode_online_test_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.fileModeOnlineTests.create');
    }

    public function store(StoreFileModeOnlineTestRequest $request)
    {
        $fileModeOnlineTest = FileModeOnlineTest::create($request->all());

        return redirect()->route('frontend.file-mode-online-tests.index');
    }

    public function edit(FileModeOnlineTest $fileModeOnlineTest)
    {
        abort_if(Gate::denies('file_mode_online_test_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.fileModeOnlineTests.edit', compact('fileModeOnlineTest'));
    }

    public function update(UpdateFileModeOnlineTestRequest $request, FileModeOnlineTest $fileModeOnlineTest)
    {
        $fileModeOnlineTest->update($request->all());

        return redirect()->route('frontend.file-mode-online-tests.index');
    }

    public function show(FileModeOnlineTest $fileModeOnlineTest)
    {
        abort_if(Gate::denies('file_mode_online_test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.fileModeOnlineTests.show', compact('fileModeOnlineTest'));
    }

    public function destroy(FileModeOnlineTest $fileModeOnlineTest)
    {
        abort_if(Gate::denies('file_mode_online_test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fileModeOnlineTest->delete();

        return back();
    }

    public function massDestroy(MassDestroyFileModeOnlineTestRequest $request)
    {
        $fileModeOnlineTests = FileModeOnlineTest::find(request('ids'));

        foreach ($fileModeOnlineTests as $fileModeOnlineTest) {
            $fileModeOnlineTest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
