@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.feeStructure.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.fee-structures.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="fee_heads">{{ trans('cruds.feeStructure.fields.fee_head') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="fee_heads[]" id="fee_heads" multiple>
                                @foreach($fee_heads as $id => $fee_head)
                                    <option value="{{ $id }}" {{ in_array($id, old('fee_heads', [])) ? 'selected' : '' }}>{{ $fee_head }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('fee_heads'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fee_heads') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.feeStructure.fields.fee_head_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fee">{{ trans('cruds.feeStructure.fields.fee') }}</label>
                            <textarea class="form-control" name="fee" id="fee">{{ old('fee') }}</textarea>
                            @if($errors->has('fee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.feeStructure.fields.fee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institute_id">{{ trans('cruds.feeStructure.fields.institute') }}</label>
                            <select class="form-control select2" name="institute_id" id="institute_id" required>
                                @foreach($institutes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('institute_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('institute'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institute') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.feeStructure.fields.institute_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="course_id">{{ trans('cruds.feeStructure.fields.course') }}</label>
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
                            <span class="help-block">{{ trans('cruds.feeStructure.fields.course_helper') }}</span>
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