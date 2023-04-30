@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.batch.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.batches.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.batch.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batch.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="start_date">{{ trans('cruds.batch.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batch.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="end_date">{{ trans('cruds.batch.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batch.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="target_date">{{ trans('cruds.batch.fields.target_date') }}</label>
                            <input class="form-control date" type="text" name="target_date" id="target_date" value="{{ old('target_date') }}" required>
                            @if($errors->has('target_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('target_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batch.fields.target_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="course_id">{{ trans('cruds.batch.fields.course') }}</label>
                            <select class="form-control select2" name="course_id" id="course_id" required>
                                @foreach($courses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('course'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('course') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batch.fields.course_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.batch.fields.type') }}</label>
                            <select class="form-control" name="type" id="type">
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Batch::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batch.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="timing">{{ trans('cruds.batch.fields.timing') }}</label>
                            <input class="form-control timepicker" type="text" name="timing" id="timing" value="{{ old('timing') }}">
                            @if($errors->has('timing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('timing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batch.fields.timing_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.batch.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Batch::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batch.fields.status_helper') }}</span>
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