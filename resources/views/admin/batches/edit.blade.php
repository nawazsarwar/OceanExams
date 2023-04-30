@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.batch.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.batches.update", [$batch->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.batch.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $batch->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.batch.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $batch->start_date) }}" required>
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_date">{{ trans('cruds.batch.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $batch->end_date) }}" required>
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="target_date">{{ trans('cruds.batch.fields.target_date') }}</label>
                <input class="form-control date {{ $errors->has('target_date') ? 'is-invalid' : '' }}" type="text" name="target_date" id="target_date" value="{{ old('target_date', $batch->target_date) }}" required>
                @if($errors->has('target_date'))
                    <span class="text-danger">{{ $errors->first('target_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.target_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.batch.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id" required>
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $batch->course->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <span class="text-danger">{{ $errors->first('course') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.batch.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Batch::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $batch->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="timing">{{ trans('cruds.batch.fields.timing') }}</label>
                <input class="form-control timepicker {{ $errors->has('timing') ? 'is-invalid' : '' }}" type="text" name="timing" id="timing" value="{{ old('timing', $batch->timing) }}">
                @if($errors->has('timing'))
                    <span class="text-danger">{{ $errors->first('timing') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.timing_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.batch.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Batch::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $batch->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
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



@endsection