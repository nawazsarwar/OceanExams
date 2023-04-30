<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFileModeOnlineTestRequest;
use App\Http\Requests\StoreFileModeOnlineTestRequest;
use App\Http\Requests\UpdateFileModeOnlineTestRequest;
use App\Models\FileModeOnlineTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FileModeOnlineTestController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('file_mode_online_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FileModeOnlineTest::query()->select(sprintf('%s.*', (new FileModeOnlineTest())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'file_mode_online_test_show';
                $editGate = 'file_mode_online_test_edit';
                $deleteGate = 'file_mode_online_test_delete';
                $crudRoutePart = 'file-mode-online-tests';

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
            $table->editColumn('quiz', function ($row) {
                return $row->quiz ? $row->quiz : '';
            });
            $table->editColumn('mode', function ($row) {
                return $row->mode ? FileModeOnlineTest::MODE_RADIO[$row->mode] : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.fileModeOnlineTests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('file_mode_online_test_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fileModeOnlineTests.create');
    }

    public function store(StoreFileModeOnlineTestRequest $request)
    {
        $fileModeOnlineTest = FileModeOnlineTest::create($request->all());

        return redirect()->route('admin.file-mode-online-tests.index');
    }

    public function edit(FileModeOnlineTest $fileModeOnlineTest)
    {
        abort_if(Gate::denies('file_mode_online_test_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fileModeOnlineTests.edit', compact('fileModeOnlineTest'));
    }

    public function update(UpdateFileModeOnlineTestRequest $request, FileModeOnlineTest $fileModeOnlineTest)
    {
        $fileModeOnlineTest->update($request->all());

        return redirect()->route('admin.file-mode-online-tests.index');
    }

    public function show(FileModeOnlineTest $fileModeOnlineTest)
    {
        abort_if(Gate::denies('file_mode_online_test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fileModeOnlineTests.show', compact('fileModeOnlineTest'));
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
