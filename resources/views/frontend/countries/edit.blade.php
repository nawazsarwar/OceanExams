@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.country.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.countries.update", [$country->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.country.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $country->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="code">{{ trans('cruds.country.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', $country->code) }}" required>
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dailing_code">{{ trans('cruds.country.fields.dailing_code') }}</label>
                            <input class="form-control" type="text" name="dailing_code" id="dailing_code" value="{{ old('dailing_code', $country->dailing_code) }}">
                            @if($errors->has('dailing_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dailing_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.dailing_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="position">{{ trans('cruds.country.fields.position') }}</label>
                            <input class="form-control" type="number" name="position" id="position" value="{{ old('position', $country->position) }}" step="1">
                            @if($errors->has('position'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('position') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.position_helper') }}</span>
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