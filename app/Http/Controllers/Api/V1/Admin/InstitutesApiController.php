<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreInstituteRequest;
use App\Http\Requests\UpdateInstituteRequest;
use App\Http\Resources\Admin\InstituteResource;
use App\Models\Institute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstitutesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('institute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstituteResource(Institute::with(['type', 'level', 'affiliations', 'partner'])->get());
    }

    public function store(StoreInstituteRequest $request)
    {
        $institute = Institute::create($request->all());
        $institute->affiliations()->sync($request->input('affiliations', []));
        if ($request->input('logo', false)) {
            $institute->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new InstituteResource($institute))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Institute $institute)
    {
        abort_if(Gate::denies('institute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstituteResource($institute->load(['type', 'level', 'affiliations', 'partner']));
    }

    public function update(UpdateInstituteRequest $request, Institute $institute)
    {
        $institute->update($request->all());
        $institute->affiliations()->sync($request->input('affiliations', []));
        if ($request->input('logo', false)) {
            if (!$institute->logo || $request->input('logo') !== $institute->logo->file_name) {
                if ($institute->logo) {
                    $institute->logo->delete();
                }
                $institute->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($institute->logo) {
            $institute->logo->delete();
        }

        return (new InstituteResource($institute))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Institute $institute)
    {
        abort_if(Gate::denies('institute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institute->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
