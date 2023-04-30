<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOmrBasedTestRequest;
use App\Http\Requests\UpdateOmrBasedTestRequest;
use App\Http\Resources\Admin\OmrBasedTestResource;
use App\Models\OmrBasedTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OmrBasedTestsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('omr_based_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OmrBasedTestResource(OmrBasedTest::all());
    }

    public function store(StoreOmrBasedTestRequest $request)
    {
        $omrBasedTest = OmrBasedTest::create($request->all());

        return (new OmrBasedTestResource($omrBasedTest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OmrBasedTest $omrBasedTest)
    {
        abort_if(Gate::denies('omr_based_test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OmrBasedTestResource($omrBasedTest);
    }

    public function update(UpdateOmrBasedTestRequest $request, OmrBasedTest $omrBasedTest)
    {
        $omrBasedTest->update($request->all());

        return (new OmrBasedTestResource($omrBasedTest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OmrBasedTest $omrBasedTest)
    {
        abort_if(Gate::denies('omr_based_test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $omrBasedTest->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
