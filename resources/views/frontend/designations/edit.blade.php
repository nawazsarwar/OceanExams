@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.designation.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.designations.update", [$designation->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.designation.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $designation->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.designation.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="code">{{ trans('cruds.designation.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', $designation->code) }}">
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.designation.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pay_grade">{{ trans('cruds.designation.fields.pay_grade') }}</label>
                            <input class="form-control" type="text" name="pay_grade" id="pay_grade" value="{{ old('pay_grade', $designation->pay_grade) }}">
                            @if($errors->has('pay_grade'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pay_grade') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.designation.fields.pay_grade_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institution_id">{{ trans('cruds.designation.fields.institution') }}</label>
                            <select class="form-control select2" name="institution_id" id="institution_id" required>
                                @foreach($institutions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('institution_id') ? old('institution_id') : $designation->institution->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('institution'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institution') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.designation.fields.institution_helper') }}</span>
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