@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employeeType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employee-types.update", [$employeeType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.employeeType.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $employeeType->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeType.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="institute_id">{{ trans('cruds.employeeType.fields.institute') }}</label>
                <select class="form-control select2 {{ $errors->has('institute') ? 'is-invalid' : '' }}" name="institute_id" id="institute_id" required>
                    @foreach($institutes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('institute_id') ? old('institute_id') : $employeeType->institute->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('institute'))
                    <span class="text-danger">{{ $errors->first('institute') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeType.fields.institute_helper') }}</span>
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