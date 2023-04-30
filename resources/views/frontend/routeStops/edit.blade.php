@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.routeStop.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.route-stops.update", [$routeStop->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.routeStop.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $routeStop->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.routeStop.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="transport_route_id">{{ trans('cruds.routeStop.fields.transport_route') }}</label>
                            <select class="form-control select2" name="transport_route_id" id="transport_route_id" required>
                                @foreach($transport_routes as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('transport_route_id') ? old('transport_route_id') : $routeStop->transport_route->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('transport_route'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transport_route') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.routeStop.fields.transport_route_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fare">{{ trans('cruds.routeStop.fields.fare') }}</label>
                            <input class="form-control" type="number" name="fare" id="fare" value="{{ old('fare', $routeStop->fare) }}" step="0.01">
                            @if($errors->has('fare'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fare') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection