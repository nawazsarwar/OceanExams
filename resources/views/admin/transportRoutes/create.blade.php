@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transportRoute.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transport-routes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.transportRoute.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transportRoute.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="institute_id">{{ trans('cruds.transportRoute.fields.institute') }}</label>
                <select class="form-control select2 {{ $errors->has('institute') ? 'is-invalid' : '' }}" name="institute_id" id="institute_id" required>
                    @foreach($institutes as $id => $entry)
                        <option value="{{ $id }}" {{ old('institute_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('institute'))
                    <span class="text-danger">{{ $errors->first('institute') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transportRoute.fields.institute_helper') }}</span>
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