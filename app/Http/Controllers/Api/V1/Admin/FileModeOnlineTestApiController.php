<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFileModeOnlineTestRequest;
use App\Http\Requests\UpdateFileModeOnlineTestRequest;
use App\Http\Resources\Admin\FileModeOnlineTestResource;
use App\Models\FileModeOnlineTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileModeOnlineTestApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('file_mode_online_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FileModeOnlineTestResource(FileModeOnlineTest::all());
    }

    public function store(StoreFileModeOnlineTestRequest $request)
    {
        $fileModeOnlineTest = FileModeOnlineTest::create($request->all());

        return (new FileModeOnlineTestResource($fileModeOnlineTest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FileModeOnlineTest $fileModeOnlineTest)
    {
        abort_if(Gate::denies('file_mode_online_test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FileModeOnlineTestResource($fileModeOnlineTest);
    }

    public function update(UpdateFileModeOnlineTestRequest $request, FileModeOnlineTest $fileModeOnlineTest)
    {
        $fileModeOnlineTest->update($request->all());

        return (new FileModeOnlineTestResource($fileModeOnlineTest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FileModeOnlineTest $fileModeOnlineTest)
    {
        abort_if(Gate::denies('file_mode_online_test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fileModeOnlineTest->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
