@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.omrBasedTest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.omr-based-tests.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="series">{{ trans('cruds.omrBasedTest.fields.series') }}</label>
                <input class="form-control {{ $errors->has('series') ? 'is-invalid' : '' }}" type="text" name="series" id="series" value="{{ old('series', '') }}" required>
                @if($errors->has('series'))
                    <span class="text-danger">{{ $errors->first('series') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.omrBasedTest.fields.series_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.omrBasedTest.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}" required>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.omrBasedTest.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="negative_mark">{{ trans('cruds.omrBasedTest.fields.negative_mark') }}</label>
                <input class="form-control {{ $errors->has('negative_mark') ? 'is-invalid' : '' }}" type="number" name="negative_mark" id="negative_mark" value="{{ old('negative_mark', '') }}" step="1">
                @if($errors->has('negative_mark'))
                    <span class="text-danger">{{ $errors->first('negative_mark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.omrBasedTest.fields.negative_mark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="correct_mark">{{ trans('cruds.omrBasedTest.fields.correct_mark') }}</label>
                <input class="form-control {{ $errors->has('correct_mark') ? 'is-invalid' : '' }}" type="number" name="correct_mark" id="correct_mark" value="{{ old('correct_mark', '') }}" step="1">
                @if($errors->has('correct_mark'))
                    <span class="text-danger">{{ $errors->first('correct_mark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.omrBasedTest.fields.correct_mark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_question">{{ trans('cruds.omrBasedTest.fields.total_question') }}</label>
                <input class="form-control {{ $errors->has('total_question') ? 'is-invalid' : '' }}" type="number" name="total_question" id="total_question" value="{{ old('total_question', '') }}" step="1">
                @if($errors->has('total_question'))
                    <span class="text-danger">{{ $errors->first('total_question') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.omrBasedTest.fields.total_question_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="target_year">{{ trans('cruds.omrBasedTest.fields.target_year') }}</label>
                <input class="form-control date {{ $errors->has('target_year') ? 'is-invalid' : '' }}" type="text" name="target_year" id="target_year" value="{{ old('target_year') }}">
                @if($errors->has('target_year'))
                    <span class="text-danger">{{ $errors->first('target_year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.omrBasedTest.fields.target_year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="test_date">{{ trans('cruds.omrBasedTest.fields.test_date') }}</label>
                <input class="form-control date {{ $errors->has('test_date') ? 'is-invalid' : '' }}" type="text" name="test_date" id="test_date" value="{{ old('test_date') }}">
                @if($errors->has('test_date'))
                    <span class="text-danger">{{ $errors->first('test_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.omrBasedTest.fields.test_date_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection