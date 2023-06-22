<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIssueBookRequest;
use App\Http\Requests\StoreIssueBookRequest;
use App\Http\Requests\UpdateIssueBookRequest;
use App\Models\Book;
use App\Models\IssueBook;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IssueBookController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('issue_book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issueBooks = IssueBook::with(['book', 'user', 'issued_by'])->get();

        return view('frontend.issueBooks.index', compact('issueBooks'));
    }

    public function create()
    {
        abort_if(Gate::denies('issue_book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $books = Book::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issued_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.issueBooks.create', compact('books', 'issued_bies', 'users'));
    }

    public function store(StoreIssueBookRequest $request)
    {
        $issueBook = IssueBook::create($request->all());

        return redirect()->route('frontend.issue-books.index');
    }

    public function edit(IssueBook $issueBook)
    {
        abort_if(Gate::denies('issue_book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $books = Book::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issued_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issueBook->load('book', 'user', 'issued_by');

        return view('frontend.issueBooks.edit', compact('books', 'issueBook', 'issued_bies', 'users'));
    }

    public function update(UpdateIssueBookRequest $request, IssueBook $issueBook)
    {
        $issueBook->update($request->all());

        return redirect()->route('frontend.issue-books.index');
    }

    public function show(IssueBook $issueBook)
    {
        abort_if(Gate::denies('issue_book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issueBook->load('book', 'user', 'issued_by');

        return view('frontend.issueBooks.show', compact('issueBook'));
    }

    public function destroy(IssueBook $issueBook)
    {
        abort_if(Gate::denies('issue_book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issueBook->delete();

        return back();
    }

    public function massDestroy(MassDestroyIssueBookRequest $request)
    {
        $issueBooks = IssueBook::find(request('ids'));

        foreach ($issueBooks as $issueBook) {
            $issueBook->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
