@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.transportVehicle.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.transport-vehicles.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.transportVehicle.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transportVehicle.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="driver_id">{{ trans('cruds.transportVehicle.fields.driver') }}</label>
                            <select class="form-control select2" name="driver_id" id="driver_id" required>
                                @foreach($drivers as $id => $entry)
                                    <option value="{{ $id }}" {{ old('driver_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('driver'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('driver') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transportVehicle.fields.driver_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="assistant_id">{{ trans('cruds.transportVehicle.fields.assistant') }}</label>
                            <select class="form-control select2" name="assistant_id" id="assistant_id">
                                @foreach($assistants as $id => $entry)
                                    <option value="{{ $id }}" {{ old('assistant_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('assistant'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assistant') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection