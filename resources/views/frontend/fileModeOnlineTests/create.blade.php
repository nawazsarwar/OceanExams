@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.fileModeOnlineTest.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.file-mode-online-tests.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="quiz">{{ trans('cruds.fileModeOnlineTest.fields.quiz') }}</label>
                            <input class="form-control" type="text" name="quiz" id="quiz" value="{{ old('quiz', '') }}" required>
                            @if($errors->has('quiz'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('quiz') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fileModeOnlineTest.fields.quiz_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.fileModeOnlineTest.fields.mode') }}</label>
                            @foreach(App\Models\FileModeOnlineTest::MODE_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="mode_{{ $key }}" name="mode" value="{{ $key }}" {{ old('mode', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="mode_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('mode'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mode') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fileModeOnlineTest.fields.mode_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="type">{{ trans('cruds.fileModeOnlineTest.fields.type') }}</label>
                            <input class="form-control" type="text" name="type" id="type" value="{{ old('type', '') }}">
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fileModeOnlineTest.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="test_date">{{ trans('cruds.fileModeOnlineTest.fields.test_date') }}</label>
                            <input class="form-control date" type="text" name="test_date" id="test_date" value="{{ old('test_date') }}">
                            @if($errors->has('test_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('test_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fileModeOnlineTest.fields.test_date_helper') }}</span>
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