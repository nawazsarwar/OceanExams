<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyQuestionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Affiliationer;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Institute;
use App\Models\Question;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QuestionsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('question_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Question::with(['institute', 'course', 'affiliationer', 'chapter', 'created_by', 'verified_by'])->select(sprintf('%s.*', (new Question)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'question_show';
                $editGate      = 'question_edit';
                $deleteGate    = 'question_delete';
                $crudRoutePart = 'questions';

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
            $table->addColumn('institute_name', function ($row) {
                return $row->institute ? $row->institute->name : '';
            });

            $table->addColumn('course_title', function ($row) {
                return $row->course ? $row->course->title : '';
            });

            $table->addColumn('affiliationer_name', function ($row) {
                return $row->affiliationer ? $row->affiliationer->name : '';
            });

            $table->addColumn('chapter_title', function ($row) {
                return $row->chapter ? $row->chapter->title : '';
            });

            $table->editColumn('chapter.title', function ($row) {
                return $row->chapter ? (is_string($row->chapter) ? $row->chapter : $row->chapter->title) : '';
            });
            $table->editColumn('paper', function ($row) {
                return $row->paper ? $row->paper : '';
            });
            $table->editColumn('question_no', function ($row) {
                return $row->question_no ? $row->question_no : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Question::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('no_of_options', function ($row) {
                return $row->no_of_options ? $row->no_of_options : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Question::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->addColumn('verified_by_name', function ($row) {
                return $row->verified_by ? $row->verified_by->name : '';
            });

            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'institute', 'course', 'affiliationer', 'chapter', 'created_by', 'verified_by']);

            return $table->make(true);
        }

        return view('admin.questions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('question_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affiliationers = Affiliationer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $chapters = Chapter::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verified_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.questions.create', compact('affiliationers', 'chapters', 'courses', 'created_bies', 'institutes', 'verified_bies'));
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $question->id]);
        }

        return redirect()->route('admin.questions.index');
    }

    public function edit(Question $question)
    {
        abort_if(Gate::denies('question_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutes = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affiliationers = Affiliationer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $chapters = Chapter::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verified_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $question->load('institute', 'course', 'affiliationer', 'chapter', 'created_by', 'verified_by');

        return view('admin.questions.edit', compact('affiliationers', 'chapters', 'courses', 'created_bies', 'institutes', 'question', 'verified_bies'));
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->all());

        return redirect()->route('admin.questions.index');
    }

    public function show(Question $question)
    {
        abort_if(Gate::denies('question_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question->load('institute', 'course', 'affiliationer', 'chapter', 'created_by', 'verified_by');

        return view('admin.questions.show', compact('question'));
    }

    public function destroy(Question $question)
    {
        abort_if(Gate::denies('question_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question->delete();

        return back();
    }

    public function massDestroy(MassDestroyQuestionRequest $request)
    {
        $questions = Question::find(request('ids'));

        foreach ($questions as $question) {
            $question->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('question_create') && Gate::denies('question_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Question();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
