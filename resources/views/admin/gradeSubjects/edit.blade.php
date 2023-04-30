@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.gradeSubject.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.grade-subjects.update", [$gradeSubject->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.gradeSubject.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $gradeSubject->title) }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gradeSubject.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="grade_id">{{ trans('cruds.gradeSubject.fields.grade') }}</label>
                <select class="form-control select2 {{ $errors->has('grade') ? 'is-invalid' : '' }}" name="grade_id" id="grade_id" required>
                    @foreach($grades as $id => $entry)
                        <option value="{{ $id }}" {{ (old('grade_id') ? old('grade_id') : $gradeSubject->grade->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('grade'))
                    <span class="text-danger">{{ $errors->first('grade') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gradeSubject.fields.grade_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="subject_id">{{ trans('cruds.gradeSubject.fields.subject') }}</label>
                <select class="form-control select2 {{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject_id" id="subject_id" required>
                    @foreach($subjects as $id => $entry)
                        <option value="{{ $id }}" {{ (old('subject_id') ? old('subject_id') : $gradeSubject->subject->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('subject'))
                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gradeSubject.fields.subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="institute_id">{{ trans('cruds.gradeSubject.fields.institute') }}</label>
                <select class="form-control select2 {{ $errors->has('institute') ? 'is-invalid' : '' }}" name="institute_id" id="institute_id" required>
                    @foreach($institutes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('institute_id') ? old('institute_id') : $gradeSubject->institute->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('institute'))
                    <span class="text-danger">{{ $errors->first('institute') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gradeSubject.fields.institute_helper') }}</span>
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