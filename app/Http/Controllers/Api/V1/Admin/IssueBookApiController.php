<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIssueBookRequest;
use App\Http\Requests\UpdateIssueBookRequest;
use App\Http\Resources\Admin\IssueBookResource;
use App\Models\IssueBook;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IssueBookApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('issue_book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IssueBookResource(IssueBook::with(['book', 'user', 'issued_by'])->get());
    }

    public function store(StoreIssueBookRequest $request)
    {
        $issueBook = IssueBook::create($request->all());

        return (new IssueBookResource($issueBook))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IssueBook $issueBook)
    {
        abort_if(Gate::denies('issue_book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IssueBookResource($issueBook->load(['book', 'user', 'issued_by']));
    }

    public function update(UpdateIssueBookRequest $request, IssueBook $issueBook)
    {
        $issueBook->update($request->all());

        return (new IssueBookResource($issueBook))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IssueBook $issueBook)
    {
        abort_if(Gate::denies('issue_book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issueBook->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
