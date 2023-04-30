@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.gradeSubject.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.grade-subjects.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="title">{{ trans('cruds.gradeSubject.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.gradeSubject.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="grade_id">{{ trans('cruds.gradeSubject.fields.grade') }}</label>
                            <select class="form-control select2" name="grade_id" id="grade_id" required>
                                @foreach($grades as $id => $entry)
                                    <option value="{{ $id }}" {{ old('grade_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('grade'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('grade') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.gradeSubject.fields.grade_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="subject_id">{{ trans('cruds.gradeSubject.fields.subject') }}</label>
                            <select class="form-control select2" name="subject_id" id="subject_id" required>
                                @foreach($subjects as $id => $entry)
                                    <option value="{{ $id }}" {{ old('subject_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subject'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subject') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.gradeSubject.fields.subject_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institute_id">{{ trans('cruds.gradeSubject.fields.institute') }}</label>
                            <select class="form-control select2" name="institute_id" id="institute_id" required>
                                @foreach($institutes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('institute_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('institute'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institute') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection