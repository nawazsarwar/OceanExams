<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPartnerRequest;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Partner;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PartnersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('partner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Partner::query()->select(sprintf('%s.*', (new Partner)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'partner_show';
                $editGate      = 'partner_edit';
                $deleteGate    = 'partner_delete';
                $crudRoutePart = 'partners';

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
            $table->editColumn('product_name', function ($row) {
                return $row->product_name ? $row->product_name : '';
            });
            $table->editColumn('prefix', function ($row) {
                return $row->prefix ? $row->prefix : '';
            });
            $table->editColumn('primary_url', function ($row) {
                return $row->primary_url ? $row->primary_url : '';
            });
            $table->editColumn('header_logo', function ($row) {
                if ($photo = $row->header_logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('header_background_color', function ($row) {
                return $row->header_background_color ? $row->header_background_color : '';
            });
            $table->editColumn('footer_background_color', function ($row) {
                return $row->footer_background_color ? $row->footer_background_color : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Partner::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'header_logo']);

            return $table->make(true);
        }

        return view('admin.partners.index');
    }

    public function create()
    {
        abort_if(Gate::denies('partner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partners.create');
    }

    public function store(StorePartnerRequest $request)
    {
        $partner = Partner::create($request->all());

        if ($request->input('header_logo', false)) {
            $partner->addMedia(storage_path('tmp/uploads/' . basename($request->input('header_logo'))))->toMediaCollection('header_logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $partner->id]);
        }

        return redirect()->route('admin.partners.index');
    }

    public function edit(Partner $partner)
    {
        abort_if(Gate::denies('partner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partners.edit', compact('partner'));
    }

    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $partner->update($request->all());

        if ($request->input('header_logo', false)) {
            if (! $partner->header_logo || $request->input('header_logo') !== $partner->header_logo->file_name) {
                if ($partner->header_logo) {
                    $partner->header_logo->delete();
                }
                $partner->addMedia(storage_path('tmp/uploads/' . basename($request->input('header_logo'))))->toMediaCollection('header_logo');
            }
        } elseif ($partner->header_logo) {
            $partner->header_logo->delete();
        }

        return redirect()->route('admin.partners.index');
    }

    public function show(Partner $partner)
    {
        abort_if(Gate::denies('partner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partners.show', compact('partner'));
    }

    public function destroy(Partner $partner)
    {
        abort_if(Gate::denies('partner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partner->delete();

        return back();
    }

    public function massDestroy(MassDestroyPartnerRequest $request)
    {
        $partners = Partner::find(request('ids'));

        foreach ($partners as $partner) {
            $partner->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('partner_create') && Gate::denies('partner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Partner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
