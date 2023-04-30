<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOmrBasedTestRequest;
use App\Http\Requests\StoreOmrBasedTestRequest;
use App\Http\Requests\UpdateOmrBasedTestRequest;
use App\Models\OmrBasedTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OmrBasedTestsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('omr_based_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $omrBasedTests = OmrBasedTest::all();

        return view('frontend.omrBasedTests.index', compact('omrBasedTests'));
    }

    public function create()
    {
        abort_if(Gate::denies('omr_based_test_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.omrBasedTests.create');
    }

    public function store(StoreOmrBasedTestRequest $request)
    {
        $omrBasedTest = OmrBasedTest::create($request->all());

        return redirect()->route('frontend.omr-based-tests.index');
    }

    public function edit(OmrBasedTest $omrBasedTest)
    {
        abort_if(Gate::denies('omr_based_test_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.omrBasedTests.edit', compact('omrBasedTest'));
    }

    public function update(UpdateOmrBasedTestRequest $request, OmrBasedTest $omrBasedTest)
    {
        $omrBasedTest->update($request->all());

        return redirect()->route('frontend.omr-based-tests.index');
    }

    public function show(OmrBasedTest $omrBasedTest)
    {
        abort_if(Gate::denies('omr_based_test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.omrBasedTests.show', compact('omrBasedTest'));
    }

    public function destroy(OmrBasedTest $omrBasedTest)
    {
        abort_if(Gate::denies('omr_based_test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $omrBasedTest->delete();

        return back();
    }

    public function massDestroy(MassDestroyOmrBasedTestRequest $request)
    {
        $omrBasedTests = OmrBasedTest::find(request('ids'));

        foreach ($omrBasedTests as $omrBasedTest) {
            $omrBasedTest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
