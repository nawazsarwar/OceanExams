<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhoneRequest;
use App\Http\Requests\UpdatePhoneRequest;
use App\Http\Resources\Admin\PhoneResource;
use App\Models\Phone;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PhonesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('phone_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PhoneResource(Phone::with(['user'])->get());
    }

    public function store(StorePhoneRequest $request)
    {
        $phone = Phone::create($request->all());

        return (new PhoneResource($phone))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Phone $phone)
    {
        abort_if(Gate::denies('phone_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PhoneResource($phone->load(['user']));
    }

    public function update(UpdatePhoneRequest $request, Phone $phone)
    {
        $phone->update($request->all());

        return (new PhoneResource($phone))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Phone $phone)
    {
        abort_if(Gate::denies('phone_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phone->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
