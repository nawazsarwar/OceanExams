@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transportVehicle.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transport-vehicles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.transportVehicle.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transportVehicle.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="driver_id">{{ trans('cruds.transportVehicle.fields.driver') }}</label>
                <select class="form-control select2 {{ $errors->has('driver') ? 'is-invalid' : '' }}" name="driver_id" id="driver_id" required>
                    @foreach($drivers as $id => $entry)
                        <option value="{{ $id }}" {{ old('driver_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('driver'))
                    <span class="text-danger">{{ $errors->first('driver') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transportVehicle.fields.driver_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assistant_id">{{ trans('cruds.transportVehicle.fields.assistant') }}</label>
                <select class="form-control select2 {{ $errors->has('assistant') ? 'is-invalid' : '' }}" name="assistant_id" id="assistant_id">
                    @foreach($assistants as $id => $entry)
                        <option value="{{ $id }}" {{ old('assistant_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assistant'))
                    <span class="text-danger">{{ $errors->first('assistant') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transportVehicle.fields.assistant_helper') }}</span>
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