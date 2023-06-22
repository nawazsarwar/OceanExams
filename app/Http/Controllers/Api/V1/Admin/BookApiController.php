<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\Admin\BookResource;
use App\Models\Book;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookResource(Book::with(['subject', 'added_by'])->get());
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->all());

        if ($request->input('cover', false)) {
            $book->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover'))))->toMediaCollection('cover');
        }

        return (new BookResource($book))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Book $book)
    {
        abort_if(Gate::denies('book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookResource($book->load(['subject', 'added_by']));
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

        return (new BookResource($book))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Book $book)
    {
        abort_if(Gate::denies('book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $book->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
