@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.routeStop.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.route-stops.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.routeStop.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.routeStop.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transport_route_id">{{ trans('cruds.routeStop.fields.transport_route') }}</label>
                <select class="form-control select2 {{ $errors->has('transport_route') ? 'is-invalid' : '' }}" name="transport_route_id" id="transport_route_id" required>
                    @foreach($transport_routes as $id => $entry)
                        <option value="{{ $id }}" {{ old('transport_route_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('transport_route'))
                    <span class="text-danger">{{ $errors->first('transport_route') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.routeStop.fields.transport_route_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fare">{{ trans('cruds.routeStop.fields.fare') }}</label>
                <input class="form-control {{ $errors->has('fare') ? 'is-invalid' : '' }}" type="number" name="fare" id="fare" value="{{ old('fare', '') }}" step="0.01">
                @if($errors->has('fare'))
                    <span class="text-danger">{{ $errors->first('fare') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.routeStop.fields.fare_helper') }}</span>
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