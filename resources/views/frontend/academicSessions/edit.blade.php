@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.academicSession.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.academic-sessions.update", [$academicSession->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.academicSession.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $academicSession->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.academicSession.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="position">{{ trans('cruds.academicSession.fields.position') }}</label>
                            <input class="form-control" type="number" name="position" id="position" value="{{ old('position', $academicSession->position) }}" step="1">
                            @if($errors->has('position'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('position') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.academicSession.fields.position_helper') }}</span>
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