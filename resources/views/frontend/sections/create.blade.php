@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.section.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.sections.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.section.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.section.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="capacity">{{ trans('cruds.section.fields.capacity') }}</label>
                            <input class="form-control" type="number" name="capacity" id="capacity" value="{{ old('capacity', '') }}" step="1">
                            @if($errors->has('capacity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('capacity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.section.fields.capacity_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="grade_id">{{ trans('cruds.section.fields.grade') }}</label>
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
                            <span class="help-block">{{ trans('cruds.section.fields.grade_helper') }}</span>
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