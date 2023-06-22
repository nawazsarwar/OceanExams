@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.enquiry.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.enquiries.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.enquiry.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.enquiry.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                @if($errors->has('middle_name'))
                    <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('cruds.enquiry.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}">
                @if($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fathers_name">{{ trans('cruds.enquiry.fields.fathers_name') }}</label>
                <input class="form-control {{ $errors->has('fathers_name') ? 'is-invalid' : '' }}" type="text" name="fathers_name" id="fathers_name" value="{{ old('fathers_name', '') }}">
                @if($errors->has('fathers_name'))
                    <span class="text-danger">{{ $errors->first('fathers_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.fathers_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mothers_name">{{ trans('cruds.enquiry.fields.mothers_name') }}</label>
                <input class="form-control {{ $errors->has('mothers_name') ? 'is-invalid' : '' }}" type="text" name="mothers_name" id="mothers_name" value="{{ old('mothers_name', '') }}">
                @if($errors->has('mothers_name'))
                    <span class="text-danger">{{ $errors->first('mothers_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.mothers_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobile_no">{{ trans('cruds.enquiry.fields.mobile_no') }}</label>
                <input class="form-control {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', '') }}" required>
                @if($errors->has('mobile_no'))
                    <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.mobile_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.enquiry.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.enquiry.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id" required>
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <span class="text-danger">{{ $errors->first('course') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.enquiry.fields.class') }}</label>
                <select class="form-control {{ $errors->has('class') ? 'is-invalid' : '' }}" name="class" id="class">
                    <option value disabled {{ old('class', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Enquiry::CLASS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('class', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('class'))
                    <span class="text-danger">{{ $errors->first('class') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.class_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="passing_year">{{ trans('cruds.enquiry.fields.passing_year') }}</label>
                <input class="form-control {{ $errors->has('passing_year') ? 'is-invalid' : '' }}" type="text" name="passing_year" id="passing_year" value="{{ old('passing_year', '') }}" required>
                @if($errors->has('passing_year'))
                    <span class="text-danger">{{ $errors->first('passing_year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.passing_year_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="message">{{ trans('cruds.enquiry.fields.message') }}</label>
                <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message" required>{{ old('message') }}</textarea>
                @if($errors->has('message'))
                    <span class="text-danger">{{ $errors->first('message') }}</span>
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



@endsection