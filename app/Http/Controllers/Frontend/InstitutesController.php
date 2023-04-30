<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInstituteRequest;
use App\Http\Requests\StoreInstituteRequest;
use App\Http\Requests\UpdateInstituteRequest;
use App\Models\Affiliationer;
use App\Models\Institute;
use App\Models\InstituteLevel;
use App\Models\InstituteType;
use App\Models\Partner;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class InstitutesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('institute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::with(['type', 'level', 'affiliations', 'partner', 'media'])->get();

        return view('frontend.institutes.index', compact('institutes'));
    }

    public function create()
    {
        abort_if(Gate::denies('institute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = InstituteType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $levels = InstituteLevel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affiliations = Affiliationer::pluck('name', 'id');

        $partners = Partner::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.institutes.create', compact('affiliations', 'levels', 'partners', 'types'));
    }

    public function store(StoreInstituteRequest $request)
    {
        $institute = Institute::create($request->all());
        $institute->affiliations()->sync($request->input('affiliations', []));
        if ($request->input('logo', false)) {
            $institute->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $institute->id]);
        }

        return redirect()->route('frontend.institutes.index');
    }

    public function edit(Institute $institute)
    {
        abort_if(Gate::denies('institute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = InstituteType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $levels = InstituteLevel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affiliations = Affiliationer::pluck('name', 'id');

        $partners = Partner::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institute->load('type', 'level', 'affiliations', 'partner');

        return view('frontend.institutes.edit', compact('affiliations', 'institute', 'levels', 'partners', 'types'));
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

        return redirect()->route('frontend.institutes.index');
    }

    public function show(Institute $institute)
    {
        abort_if(Gate::denies('institute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institute->load('type', 'level', 'affiliations', 'partner');

        return view('frontend.institutes.show', compact('institute'));
    }

    public function destroy(Institute $institute)
    {
        abort_if(Gate::denies('institute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institute->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstituteRequest $request)
    {
        $institutes = Institute::find(request('ids'));

        foreach ($institutes as $institute) {
            $institute->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('institute_create') && Gate::denies('institute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Institute();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
