<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\Admin\CourseResource;
use App\Models\Course;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoursesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource(Course::with(['institute'])->get());
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());

        foreach ($request->input('thumbnail', []) as $file) {
            $course->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('thumbnail');
        }

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource($course->load(['institute']));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());

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

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
