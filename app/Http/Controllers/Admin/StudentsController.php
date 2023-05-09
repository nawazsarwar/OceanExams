<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\RouteStop;
use App\Models\Section;
use App\Models\Student;
use App\Models\TransportRoute;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Student::with(['sections', 'users', 'transport_route', 'transport_stop'])->select(sprintf('%s.*', (new Student)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'student_show';
                $editGate      = 'student_edit';
                $deleteGate    = 'student_delete';
                $crudRoutePart = 'students';

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
            $table->editColumn('mobile_no', function ($row) {
                return $row->mobile_no ? $row->mobile_no : '';
            });
            $table->editColumn('fathers_name', function ($row) {
                return $row->fathers_name ? $row->fathers_name : '';
            });
            $table->editColumn('mothers_name', function ($row) {
                return $row->mothers_name ? $row->mothers_name : '';
            });
            $table->editColumn('parents_contact', function ($row) {
                return $row->parents_contact ? $row->parents_contact : '';
            });

            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('archived', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->archived ? 'checked' : null) . '>';
            });
            $table->editColumn('roll_no', function ($row) {
                return $row->roll_no ? $row->roll_no : '';
            });
            $table->editColumn('section', function ($row) {
                $labels = [];
                foreach ($row->sections as $section) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $section->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'archived', 'section']);

            return $table->make(true);
        }

        return view('admin.students.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sections = Section::pluck('title', 'id');

        $users = User::pluck('name', 'id');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_stops = RouteStop::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.students.create', compact('sections', 'transport_routes', 'transport_stops', 'users'));
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());
        $student->sections()->sync($request->input('sections', []));
        $student->users()->sync($request->input('users', []));
        if ($request->input('image', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }

        return redirect()->route('admin.students.index');
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sections = Section::pluck('title', 'id');

        $users = User::pluck('name', 'id');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_stops = RouteStop::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student->load('sections', 'users', 'transport_route', 'transport_stop');

        return view('admin.students.edit', compact('sections', 'student', 'transport_routes', 'transport_stops', 'users'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());
        $student->sections()->sync($request->input('sections', []));
        $student->users()->sync($request->input('users', []));
        if ($request->input('image', false)) {
            if (! $student->image || $request->input('image') !== $student->image->file_name) {
                if ($student->image) {
                    $student->image->delete();
                }
                $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($student->image) {
            $student->image->delete();
        }

        return redirect()->route('admin.students.index');
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->load('sections', 'users', 'transport_route', 'transport_stop');

        return view('admin.students.show', compact('student'));
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentRequest $request)
    {
        $students = Student::find(request('ids'));

        foreach ($students as $student) {
            $student->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Student();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
