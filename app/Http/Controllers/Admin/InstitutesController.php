<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class InstitutesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('institute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Institute::with(['type', 'level', 'affiliations', 'partner'])->select(sprintf('%s.*', (new Institute)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'institute_show';
                $editGate      = 'institute_edit';
                $deleteGate    = 'institute_delete';
                $crudRoutePart = 'institutes';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('subdomain', function ($row) {
                return $row->subdomain ? $row->subdomain : '';
            });
            $table->editColumn('hostname', function ($row) {
                return $row->hostname ? $row->hostname : '';
            });
            $table->editColumn('public_email', function ($row) {
                return $row->public_email ? $row->public_email : '';
            });
            $table->editColumn('public_mobile', function ($row) {
                return $row->public_mobile ? $row->public_mobile : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('header_background_color', function ($row) {
                return $row->header_background_color ? $row->header_background_color : '';
            });
            $table->editColumn('footer_background_color', function ($row) {
                return $row->footer_background_color ? $row->footer_background_color : '';
            });
            $table->addColumn('type_title', function ($row) {
                return $row->type ? $row->type->title : '';
            });

            $table->addColumn('level_name', function ($row) {
                return $row->level ? $row->level->name : '';
            });

            $table->editColumn('affiliation', function ($row) {
                $labels = [];
                foreach ($row->affiliations as $affiliation) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $affiliation->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('affiliation_no', function ($row) {
                return $row->affiliation_no ? $row->affiliation_no : '';
            });
            $table->editColumn('template', function ($row) {
                return $row->template ? $row->template : '';
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : '';
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : '';
            });
            $table->addColumn('partner_name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Institute::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'logo', 'type', 'level', 'affiliation', 'partner']);

            return $table->make(true);
        }

        return view('admin.institutes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('institute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = InstituteType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $levels = InstituteLevel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affiliations = Affiliationer::pluck('name', 'id');

        $partners = Partner::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.institutes.create', compact('affiliations', 'levels', 'partners', 'types'));
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

        return redirect()->route('admin.institutes.index');
    }

    public function edit(Institute $institute)
    {
        abort_if(Gate::denies('institute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = InstituteType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $levels = InstituteLevel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affiliations = Affiliationer::pluck('name', 'id');

        $partners = Partner::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institute->load('type', 'level', 'affiliations', 'partner');

        return view('admin.institutes.edit', compact('affiliations', 'institute', 'levels', 'partners', 'types'));
    }

    public function update(UpdateInstituteRequest $request, Institute $institute)
    {
        $institute->update($request->all());
        $institute->affiliations()->sync($request->input('affiliations', []));
        if ($request->input('logo', false)) {
            if (! $institute->logo || $request->input('logo') !== $institute->logo->file_name) {
                if ($institute->logo) {
                    $institute->logo->delete();
                }
                $institute->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($institute->logo) {
            $institute->logo->delete();
        }

        return redirect()->route('admin.institutes.index');
    }

    public function show(Institute $institute)
    {
        abort_if(Gate::denies('institute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institute->load('type', 'level', 'affiliations', 'partner');

        return view('admin.institutes.show', compact('institute'));
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
