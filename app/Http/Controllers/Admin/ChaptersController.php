<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyChapterRequest;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Models\Chapter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChaptersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('chapter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Chapter::query()->select(sprintf('%s.*', (new Chapter)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'chapter_show';
                $editGate      = 'chapter_edit';
                $deleteGate    = 'chapter_delete';
                $crudRoutePart = 'chapters';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.chapters.index');
    }

    public function create()
    {
        abort_if(Gate::denies('chapter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.chapters.create');
    }

    public function store(StoreChapterRequest $request)
    {
        $chapter = Chapter::create($request->all());

        return redirect()->route('admin.chapters.index');
    }

    public function edit(Chapter $chapter)
    {
        abort_if(Gate::denies('chapter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.chapters.edit', compact('chapter'));
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        $chapter->update($request->all());

        return redirect()->route('admin.chapters.index');
    }

    public function show(Chapter $chapter)
    {
        abort_if(Gate::denies('chapter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.chapters.show', compact('chapter'));
    }

    public function destroy(Chapter $chapter)
    {
        abort_if(Gate::denies('chapter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapter->delete();

        return back();
    }

    public function massDestroy(MassDestroyChapterRequest $request)
    {
        $chapters = Chapter::find(request('ids'));

        foreach ($chapters as $chapter) {
            $chapter->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
