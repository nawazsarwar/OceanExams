<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyChapterRequest;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Models\Chapter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChaptersController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('chapter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapters = Chapter::all();

        return view('frontend.chapters.index', compact('chapters'));
    }

    public function create()
    {
        abort_if(Gate::denies('chapter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.chapters.create');
    }

    public function store(StoreChapterRequest $request)
    {
        $chapter = Chapter::create($request->all());

        return redirect()->route('frontend.chapters.index');
    }

    public function edit(Chapter $chapter)
    {
        abort_if(Gate::denies('chapter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.chapters.edit', compact('chapter'));
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        $chapter->update($request->all());

        return redirect()->route('frontend.chapters.index');
    }

    public function show(Chapter $chapter)
    {
        abort_if(Gate::denies('chapter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.chapters.show', compact('chapter'));
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
