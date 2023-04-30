<?php

namespace App\Http\Controllers\Frontend;

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

class StudentsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::with(['course', 'batch', 'transport_route', 'transport_stop', 'media'])->get();

        return view('frontend.students.index', compact('students'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_stops = RouteStop::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.students.create', compact('batches', 'courses', 'transport_routes', 'transport_stops'));
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

        return redirect()->route('frontend.students.index');
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_routes = TransportRoute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transport_stops = RouteStop::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student->load('course', 'batch', 'transport_route', 'transport_stop');

        return view('frontend.students.edit', compact('batches', 'courses', 'student', 'transport_routes', 'transport_stops'));
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

        return redirect()->route('frontend.students.index');
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->load('course', 'batch', 'transport_route', 'transport_stop');

        return view('frontend.students.show', compact('student'));
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
