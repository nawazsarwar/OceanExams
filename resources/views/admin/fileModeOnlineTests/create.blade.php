@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fileModeOnlineTest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.file-mode-online-tests.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="quiz">{{ trans('cruds.fileModeOnlineTest.fields.quiz') }}</label>
                <input class="form-control {{ $errors->has('quiz') ? 'is-invalid' : '' }}" type="text" name="quiz" id="quiz" value="{{ old('quiz', '') }}" required>
                @if($errors->has('quiz'))
                    <span class="text-danger">{{ $errors->first('quiz') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fileModeOnlineTest.fields.quiz_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.fileModeOnlineTest.fields.mode') }}</label>
                @foreach(App\Models\FileModeOnlineTest::MODE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('mode') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="mode_{{ $key }}" name="mode" value="{{ $key }}" {{ old('mode', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="mode_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('mode'))
                    <span class="text-danger">{{ $errors->first('mode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fileModeOnlineTest.fields.mode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.fileModeOnlineTest.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fileModeOnlineTest.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="test_date">{{ trans('cruds.fileModeOnlineTest.fields.test_date') }}</label>
                <input class="form-control date {{ $errors->has('test_date') ? 'is-invalid' : '' }}" type="text" name="test_date" id="test_date" value="{{ old('test_date') }}">
                @if($errors->has('test_date'))
                    <span class="text-danger">{{ $errors->first('test_date') }}</span>
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



@endsection