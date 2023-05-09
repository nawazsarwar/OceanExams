<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPhoneRequest;
use App\Http\Requests\StorePhoneRequest;
use App\Http\Requests\UpdatePhoneRequest;
use App\Models\Phone;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PhonesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('phone_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phones = Phone::with(['user'])->get();

        return view('frontend.phones.index', compact('phones'));
    }

    public function create()
    {
        abort_if(Gate::denies('phone_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.phones.create', compact('users'));
    }

    public function store(StorePhoneRequest $request)
    {
        $phone = Phone::create($request->all());

        return redirect()->route('frontend.phones.index');
    }

    public function edit(Phone $phone)
    {
        abort_if(Gate::denies('phone_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $phone->load('user');

        return view('frontend.phones.edit', compact('phone', 'users'));
    }

    public function update(UpdatePhoneRequest $request, Phone $phone)
    {
        $phone->update($request->all());

        return redirect()->route('frontend.phones.index');
    }

    public function show(Phone $phone)
    {
        abort_if(Gate::denies('phone_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phone->load('user');

        return view('frontend.phones.show', compact('phone'));
    }

    public function destroy(Phone $phone)
    {
        abort_if(Gate::denies('phone_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phone->delete();

        return back();
    }

    public function massDestroy(MassDestroyPhoneRequest $request)
    {
        $phones = Phone::find(request('ids'));

        foreach ($phones as $phone) {
            $phone->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
