<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Institute;
use App\Models\Subject;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoursesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Course::with(['subjects', 'institute'])->select(sprintf('%s.*', (new Course)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'course_show';
                $editGate      = 'course_edit';
                $deleteGate    = 'course_delete';
                $crudRoutePart = 'courses';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('subjects', function ($row) {
                $labels = [];
                foreach ($row->subjects as $subject) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $subject->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('thumbnail', function ($row) {
                if (! $row->thumbnail) {
                    return '';
                }
                $links = [];
                foreach ($row->thumbnail as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('is_published', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_published ? 'checked' : null) . '>';
            });
            $table->addColumn('institute_name', function ($row) {
                return $row->institute ? $row->institute->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'subjects', 'thumbnail', 'is_published', 'institute']);

            return $table->make(true);
        }

        return view('admin.courses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('name', 'id');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courses.create', compact('institutes', 'subjects'));
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());
        $course->subjects()->sync($request->input('subjects', []));
        foreach ($request->input('thumbnail', []) as $file) {
            $course->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('thumbnail');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $course->id]);
        }

        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('name', 'id');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $course->load('subjects', 'institute');

        return view('admin.courses.edit', compact('course', 'institutes', 'subjects'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());
        $course->subjects()->sync($request->input('subjects', []));
        if (count($course->thumbnail) > 0) {
            foreach ($course->thumbnail as $media) {
                if (! in_array($media->file_name, $request->input('thumbnail', []))) {
                    $media->delete();
                }
            }
        }
        $media = $course->thumbnail->pluck('file_name')->toArray();
        foreach ($request->input('thumbnail', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $course->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('thumbnail');
            }
        }

        return redirect()->route('admin.courses.index');
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('subjects', 'institute');

        return view('admin.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseRequest $request)
    {
        $courses = Course::find(request('ids'));

        foreach ($courses as $course) {
            $course->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_create') && Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Course();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
