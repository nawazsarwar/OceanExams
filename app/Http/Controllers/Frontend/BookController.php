<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBookRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Subject;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $books = Book::with(['subject', 'added_by', 'media'])->get();

        return view('frontend.books.index', compact('books'));
    }

    public function create()
    {
        abort_if(Gate::denies('book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $added_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.books.create', compact('added_bies', 'subjects'));
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->all());

        if ($request->input('cover', false)) {
            $book->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover'))))->toMediaCollection('cover');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $book->id]);
        }

        return redirect()->route('frontend.books.index');
    }

    public function edit(Book $book)
    {
        abort_if(Gate::denies('book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $added_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $book->load('subject', 'added_by');

        return view('frontend.books.edit', compact('added_bies', 'book', 'subjects'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->all());

        if ($request->input('cover', false)) {
            if (! $book->cover || $request->input('cover') !== $book->cover->file_name) {
                if ($book->cover) {
                    $book->cover->delete();
                }
                $book->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover'))))->toMediaCollection('cover');
            }
        } elseif ($book->cover) {
            $book->cover->delete();
        }

        return redirect()->route('frontend.books.index');
    }

    public function show(Book $book)
    {
        abort_if(Gate::denies('book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $book->load('subject', 'added_by');

        return view('frontend.books.show', compact('book'));
    }

    public function destroy(Book $book)
    {
        abort_if(Gate::denies('book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $book->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookRequest $request)
    {
        $books = Book::find(request('ids'));

        foreach ($books as $book) {
            $book->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('book_create') && Gate::denies('book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Book();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
