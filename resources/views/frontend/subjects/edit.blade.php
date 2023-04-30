@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.subject.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.subjects.update", [$subject->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.subject.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $subject->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subject.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.subject.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Subject::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $subject->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subject.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.subject.fields.remarks') }}</label>
                            <input class="form-control" type="text" name="remarks" id="remarks" value="{{ old('remarks', $subject->remarks) }}">
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subject.fields.remarks_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institute_id">{{ trans('cruds.subject.fields.institute') }}</label>
                            <select class="form-control select2" name="institute_id" id="institute_id" required>
                                @foreach($institutes as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('institute_id') ? old('institute_id') : $subject->institute->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('institute'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institute') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subject.fields.institute_helper') }}</span>
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