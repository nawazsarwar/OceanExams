@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.chapter.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.chapters.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.chapter.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.chapter.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="grade_subject_id">{{ trans('cruds.chapter.fields.grade_subject') }}</label>
                            <select class="form-control select2" name="grade_subject_id" id="grade_subject_id" required>
                                @foreach($grade_subjects as $id => $entry)
                                    <option value="{{ $id }}" {{ old('grade_subject_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('grade_subject'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('grade_subject') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.chapter.fields.grade_subject_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.chapter.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection