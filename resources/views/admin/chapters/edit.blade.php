@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.chapter.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.chapters.update", [$chapter->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.chapter.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $chapter->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.chapter.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="grade_subject_id">{{ trans('cruds.chapter.fields.grade_subject') }}</label>
                <select class="form-control select2 {{ $errors->has('grade_subject') ? 'is-invalid' : '' }}" name="grade_subject_id" id="grade_subject_id" required>
                    @foreach($grade_subjects as $id => $entry)
                        <option value="{{ $id }}" {{ (old('grade_subject_id') ? old('grade_subject_id') : $chapter->grade_subject->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('grade_subject'))
                    <span class="text-danger">{{ $errors->first('grade_subject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.chapter.fields.grade_subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.chapter.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $chapter->status) }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.chapter.fields.status_helper') }}</span>
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