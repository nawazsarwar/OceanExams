@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.employeeType.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.employee-types.update", [$employeeType->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.employeeType.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $employeeType->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeType.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institute_id">{{ trans('cruds.employeeType.fields.institute') }}</label>
                            <select class="form-control select2" name="institute_id" id="institute_id" required>
                                @foreach($institutes as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('institute_id') ? old('institute_id') : $employeeType->institute->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('institute'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institute') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeType.fields.institute_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institution_id">{{ trans('cruds.employeeType.fields.institution') }}</label>
                            <select class="form-control select2" name="institution_id" id="institution_id" required>
                                @foreach($institutions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('institution_id') ? old('institution_id') : $employeeType->institution->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('institution'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institution') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeType.fields.institution_helper') }}</span>
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