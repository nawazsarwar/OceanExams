@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.omrBasedTest.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.omr-based-tests.update", [$omrBasedTest->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="series">{{ trans('cruds.omrBasedTest.fields.series') }}</label>
                            <input class="form-control" type="text" name="series" id="series" value="{{ old('series', $omrBasedTest->series) }}" required>
                            @if($errors->has('series'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('series') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.omrBasedTest.fields.series_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="type">{{ trans('cruds.omrBasedTest.fields.type') }}</label>
                            <input class="form-control" type="text" name="type" id="type" value="{{ old('type', $omrBasedTest->type) }}" required>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.omrBasedTest.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="negative_mark">{{ trans('cruds.omrBasedTest.fields.negative_mark') }}</label>
                            <input class="form-control" type="number" name="negative_mark" id="negative_mark" value="{{ old('negative_mark', $omrBasedTest->negative_mark) }}" step="1">
                            @if($errors->has('negative_mark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('negative_mark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.omrBasedTest.fields.negative_mark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="correct_mark">{{ trans('cruds.omrBasedTest.fields.correct_mark') }}</label>
                            <input class="form-control" type="number" name="correct_mark" id="correct_mark" value="{{ old('correct_mark', $omrBasedTest->correct_mark) }}" step="1">
                            @if($errors->has('correct_mark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('correct_mark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.omrBasedTest.fields.correct_mark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_question">{{ trans('cruds.omrBasedTest.fields.total_question') }}</label>
                            <input class="form-control" type="number" name="total_question" id="total_question" value="{{ old('total_question', $omrBasedTest->total_question) }}" step="1">
                            @if($errors->has('total_question'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_question') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.omrBasedTest.fields.total_question_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="target_year">{{ trans('cruds.omrBasedTest.fields.target_year') }}</label>
                            <input class="form-control date" type="text" name="target_year" id="target_year" value="{{ old('target_year', $omrBasedTest->target_year) }}">
                            @if($errors->has('target_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('target_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.omrBasedTest.fields.target_year_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="test_date">{{ trans('cruds.omrBasedTest.fields.test_date') }}</label>
                            <input class="form-control date" type="text" name="test_date" id="test_date" value="{{ old('test_date', $omrBasedTest->test_date) }}">
                            @if($errors->has('test_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('test_date') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection