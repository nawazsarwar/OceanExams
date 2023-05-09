<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOmrBasedTestRequest;
use App\Http\Requests\StoreOmrBasedTestRequest;
use App\Http\Requests\UpdateOmrBasedTestRequest;
use App\Models\OmrBasedTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OmrBasedTestsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('omr_based_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OmrBasedTest::query()->select(sprintf('%s.*', (new OmrBasedTest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'omr_based_test_show';
                $editGate      = 'omr_based_test_edit';
                $deleteGate    = 'omr_based_test_delete';
                $crudRoutePart = 'omr-based-tests';

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
            $table->editColumn('series', function ($row) {
                return $row->series ? $row->series : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('negative_mark', function ($row) {
                return $row->negative_mark ? $row->negative_mark : '';
            });
            $table->editColumn('correct_mark', function ($row) {
                return $row->correct_mark ? $row->correct_mark : '';
            });
            $table->editColumn('total_question', function ($row) {
                return $row->total_question ? $row->total_question : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.omrBasedTests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('omr_based_test_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.omrBasedTests.create');
    }

    public function store(StoreOmrBasedTestRequest $request)
    {
        $omrBasedTest = OmrBasedTest::create($request->all());

        return redirect()->route('admin.omr-based-tests.index');
    }

    public function edit(OmrBasedTest $omrBasedTest)
    {
        abort_if(Gate::denies('omr_based_test_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.omrBasedTests.edit', compact('omrBasedTest'));
    }

    public function update(UpdateOmrBasedTestRequest $request, OmrBasedTest $omrBasedTest)
    {
        $omrBasedTest->update($request->all());

        return redirect()->route('admin.omr-based-tests.index');
    }

    public function show(OmrBasedTest $omrBasedTest)
    {
        abort_if(Gate::denies('omr_based_test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.omrBasedTests.show', compact('omrBasedTest'));
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
