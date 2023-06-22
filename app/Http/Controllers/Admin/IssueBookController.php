<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class IssueBookController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('issue_book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IssueBook::with(['book', 'user', 'issued_by'])->select(sprintf('%s.*', (new IssueBook)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'issue_book_show';
                $editGate      = 'issue_book_edit';
                $deleteGate    = 'issue_book_delete';
                $crudRoutePart = 'issue-books';

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
            $table->addColumn('book_title', function ($row) {
                return $row->book ? $row->book->title : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });
            $table->addColumn('issued_by_name', function ($row) {
                return $row->issued_by ? $row->issued_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'book', 'user', 'issued_by']);

            return $table->make(true);
        }

        return view('admin.issueBooks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('issue_book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $books = Book::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issued_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.issueBooks.create', compact('books', 'issued_bies', 'users'));
    }

    public function store(StoreIssueBookRequest $request)
    {
        $issueBook = IssueBook::create($request->all());

        return redirect()->route('admin.issue-books.index');
    }

    public function edit(IssueBook $issueBook)
    {
        abort_if(Gate::denies('issue_book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $books = Book::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issued_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issueBook->load('book', 'user', 'issued_by');

        return view('admin.issueBooks.edit', compact('books', 'issueBook', 'issued_bies', 'users'));
    }

    public function update(UpdateIssueBookRequest $request, IssueBook $issueBook)
    {
        $issueBook->update($request->all());

        return redirect()->route('admin.issue-books.index');
    }

    public function show(IssueBook $issueBook)
    {
        abort_if(Gate::denies('issue_book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issueBook->load('book', 'user', 'issued_by');

        return view('admin.issueBooks.show', compact('issueBook'));
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
