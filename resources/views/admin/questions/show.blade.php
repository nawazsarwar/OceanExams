@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.question.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.id') }}
                        </th>
                        <td>
                            {{ $question->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.institute') }}
                        </th>
                        <td>
                            {{ $question->institute->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.course') }}
                        </th>
                        <td>
                            {{ $question->course->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.affiliationer') }}
                        </th>
                        <td>
                            {{ $question->affiliationer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.chapter') }}
                        </th>
                        <td>
                            {{ $question->chapter->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.paper') }}
                        </th>
                        <td>
                            {{ $question->paper }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.question_no') }}
                        </th>
                        <td>
                            {{ $question->question_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.description') }}
                        </th>
                        <td>
                            {!! $question->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Question::TYPE_SELECT[$question->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.no_of_options') }}
                        </th>
                        <td>
                            {{ $question->no_of_options }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.option_1') }}
                        </th>
                        <td>
                            {!! $question->option_1 !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.option_2') }}
                        </th>
                        <td>
                            {!! $question->option_2 !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.option_3') }}
                        </th>
                        <td>
                            {!! $question->option_3 !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.option_4') }}
                        </th>
                        <td>
                            {!! $question->option_4 !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.option_5') }}
                        </th>
                        <td>
                            {!! $question->option_5 !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.option_6') }}
                        </th>
                        <td>
                            {!! $question->option_6 !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.correct_option') }}
                        </th>
                        <td>
                            {!! $question->correct_option !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Question::STATUS_SELECT[$question->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.created_by') }}
                        </th>
                        <td>
                            {{ $question->created_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.verified_by') }}
                        </th>
                        <td>
                            {{ $question->verified_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.verified_at') }}
                        </th>
                        <td>
                            {{ $question->verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.remarks') }}
                        </th>
                        <td>
                            {{ $question->remarks }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection