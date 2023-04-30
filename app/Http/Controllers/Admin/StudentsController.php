<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Batch;
use App\Models\Course;
use App\Models\RouteStop;
use App\Models\Student;
use App\Models\TransportRoute;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Student::with(['course', 'batch', 'transport_route', 'transport_stop'])->select(sprintf('%s.*', (new Student)->table));
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
            $table->addColumn('course_title', function ($row) {
                return $row->course ? $row->course->title : '';
            });

            $table->addColumn('batch_title', function ($row) {
                return $row->batch ? $row->batch->title : '';
            });

            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
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
            $table->editColumn('image_verified', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->image_verified ? 'checked' : null) . '>';
            });
            $table->editColumn('archived', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->archived ? 'checked' : null) . '>';
            });
            $table->editColumn('enrollment_no', function ($row) {
                return $row->enrollment_no ? $row->enrollment_no : '';
            });
            $table->editColumn('roll_no', function ($row) {
                return $row->roll_no ? $row->roll_no : '';
            });
            $table->editColumn('id_card_no', function ($row) {
                return $row->id_card_no ? $row->id_card_no : '';
            });
            $table->addColumn('transport_route_name', function ($row) {
                return $row->transport_route ? $row->transport_route->name : '';
            });

            $table->addColumn('transport_stop_name', function ($row) {
                return $row->transport_stop ? $row->transport_stop->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'course', 'batch', 'image', 'image_verified', 'archived', 'transport_route', 'transport_stop']);

            return $table->make(true);
        }

        return view('admin.students.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_stops = RouteStop::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.students.create', compact('batches', 'courses', 'transport_routes', 'transport_stops'));
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());

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

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_stops = RouteStop::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student->load('course', 'batch', 'transport_route', 'transport_stop');

        return view('admin.students.edit', compact('batches', 'courses', 'student', 'transport_routes', 'transport_stops'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

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

        $student->load('course', 'batch', 'transport_route', 'transport_stop');

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
