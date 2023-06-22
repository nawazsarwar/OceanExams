@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.enquiry.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.enquiries.update", [$enquiry->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="first_name">{{ trans('cruds.enquiry.fields.first_name') }}</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name', $enquiry->first_name) }}" required>
                            @if($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">{{ trans('cruds.enquiry.fields.middle_name') }}</label>
                            <input class="form-control" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $enquiry->middle_name) }}">
                            @if($errors->has('middle_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('middle_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.middle_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ trans('cruds.enquiry.fields.last_name') }}</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old('last_name', $enquiry->last_name) }}">
                            @if($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.last_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fathers_name">{{ trans('cruds.enquiry.fields.fathers_name') }}</label>
                            <input class="form-control" type="text" name="fathers_name" id="fathers_name" value="{{ old('fathers_name', $enquiry->fathers_name) }}">
                            @if($errors->has('fathers_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fathers_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.fathers_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mothers_name">{{ trans('cruds.enquiry.fields.mothers_name') }}</label>
                            <input class="form-control" type="text" name="mothers_name" id="mothers_name" value="{{ old('mothers_name', $enquiry->mothers_name) }}">
                            @if($errors->has('mothers_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mothers_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.mothers_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="mobile_no">{{ trans('cruds.enquiry.fields.mobile_no') }}</label>
                            <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', $enquiry->mobile_no) }}" required>
                            @if($errors->has('mobile_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.mobile_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.enquiry.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $enquiry->email) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="course_id">{{ trans('cruds.enquiry.fields.course') }}</label>
                            <select class="form-control select2" name="course_id" id="course_id" required>
                                @foreach($courses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $enquiry->course->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('course'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('course') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.course_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.enquiry.fields.class') }}</label>
                            <select class="form-control" name="class" id="class">
                                <option value disabled {{ old('class', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Enquiry::CLASS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('class', $enquiry->class) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('class'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('class') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.class_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="passing_year">{{ trans('cruds.enquiry.fields.passing_year') }}</label>
                            <input class="form-control" type="text" name="passing_year" id="passing_year" value="{{ old('passing_year', $enquiry->passing_year) }}" required>
                            @if($errors->has('passing_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('passing_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.passing_year_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="message">{{ trans('cruds.enquiry.fields.message') }}</label>
                            <textarea class="form-control" name="message" id="message" required>{{ old('message', $enquiry->message) }}</textarea>
                            @if($errors->has('message'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('message') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enquiry.fields.message_helper') }}</span>
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