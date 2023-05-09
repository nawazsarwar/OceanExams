@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.phone.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.phones.update", [$phone->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="number">{{ trans('cruds.phone.fields.number') }}</label>
                            <input class="form-control" type="text" name="number" id="number" value="{{ old('number', $phone->number) }}" required>
                            @if($errors->has('number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.phone.fields.number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.phone.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $phone->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.phone.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.phone.fields.category') }}</label>
                            <select class="form-control" name="category" id="category" required>
                                <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Phone::CATEGORY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('category', $phone->category) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.phone.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.phone.fields.type') }}</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Phone::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', $phone->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.phone.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dailing_code">{{ trans('cruds.phone.fields.dailing_code') }}</label>
                            <input class="form-control" type="text" name="dailing_code" id="dailing_code" value="{{ old('dailing_code', $phone->dailing_code) }}">
                            @if($errors->has('dailing_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dailing_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.phone.fields.dailing_code_helper') }}</span>
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