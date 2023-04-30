@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.feesStructure.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.fees-structures.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="course_id">{{ trans('cruds.feesStructure.fields.course') }}</label>
                            <select class="form-control select2" name="course_id" id="course_id" required>
                                @foreach($courses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('course'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('course') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.feesStructure.fields.course_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="batch_id">{{ trans('cruds.feesStructure.fields.batch') }}</label>
                            <select class="form-control select2" name="batch_id" id="batch_id" required>
                                @foreach($batches as $id => $entry)
                                    <option value="{{ $id }}" {{ old('batch_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('batch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('batch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.feesStructure.fields.batch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fee">{{ trans('cruds.feesStructure.fields.fee') }}</label>
                            <textarea class="form-control" name="fee" id="fee">{{ old('fee') }}</textarea>
                            @if($errors->has('fee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.feesStructure.fields.fee_helper') }}</span>
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