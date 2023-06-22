<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLedgerRequest;
use App\Http\Requests\StoreLedgerRequest;
use App\Http\Requests\UpdateLedgerRequest;
use App\Models\FeeStructure;
use App\Models\Institute;
use App\Models\Ledger;
use App\Models\Student;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LedgerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ledger_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ledgers = Ledger::with(['student', 'fee_structure', 'institute', 'added_by'])->get();

        return view('frontend.ledgers.index', compact('ledgers'));
    }

    public function create()
    {
        abort_if(Gate::denies('ledger_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fee_structures = FeeStructure::pluck('fee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $added_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.ledgers.create', compact('added_bies', 'fee_structures', 'institutes', 'students'));
    }

    public function store(StoreLedgerRequest $request)
    {
        $ledger = Ledger::create($request->all());

        return redirect()->route('frontend.ledgers.index');
    }

    public function edit(Ledger $ledger)
    {
        abort_if(Gate::denies('ledger_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fee_structures = FeeStructure::pluck('fee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $added_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ledger->load('student', 'fee_structure', 'institute', 'added_by');

        return view('frontend.ledgers.edit', compact('added_bies', 'fee_structures', 'institutes', 'ledger', 'students'));
    }

    public function update(UpdateLedgerRequest $request, Ledger $ledger)
    {
        $ledger->update($request->all());

        return redirect()->route('frontend.ledgers.index');
    }

    public function show(Ledger $ledger)
    {
        abort_if(Gate::denies('ledger_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ledger->load('student', 'fee_structure', 'institute', 'added_by');

        return view('frontend.ledgers.show', compact('ledger'));
    }

    public function destroy(Ledger $ledger)
    {
        abort_if(Gate::denies('ledger_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ledger->delete();

        return back();
    }

    public function massDestroy(MassDestroyLedgerRequest $request)
    {
        $ledgers = Ledger::find(request('ids'));

        foreach ($ledgers as $ledger) {
            $ledger->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
