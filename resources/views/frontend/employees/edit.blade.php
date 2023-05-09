@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.employee.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.employees.update", [$employee->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.employee.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="contact">{{ trans('cruds.employee.fields.contact') }}</label>
                            <input class="form-control" type="text" name="contact" id="contact" value="{{ old('contact', $employee->contact) }}" required>
                            @if($errors->has('contact'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.contact_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.employee.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $employee->email) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">{{ trans('cruds.employee.fields.date_of_birth') }}</label>
                            <input class="form-control date" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                            @if($errors->has('date_of_birth'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_of_birth') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.date_of_birth_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.employee.fields.gender') }}</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Employee::GENDER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('gender', $employee->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gender'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gender') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.gender_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photo">{{ trans('cruds.employee.fields.photo') }}</label>
                            <div class="needsclick dropzone" id="photo-dropzone">
                            </div>
                            @if($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.photo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="signature">{{ trans('cruds.employee.fields.signature') }}</label>
                            <div class="needsclick dropzone" id="signature-dropzone">
                            </div>
                            @if($errors->has('signature'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('signature') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.signature_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="subjects">{{ trans('cruds.employee.fields.subjects') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="subjects[]" id="subjects" multiple>
                                @foreach($subjects as $id => $subject)
                                    <option value="{{ $id }}" {{ (in_array($id, old('subjects', [])) || $employee->subjects->contains($id)) ? 'selected' : '' }}>{{ $subject }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subjects'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subjects') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.subjects_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="designation_id">{{ trans('cruds.employee.fields.designation') }}</label>
                            <select class="form-control select2" name="designation_id" id="designation_id" required>
                                @foreach($designations as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('designation_id') ? old('designation_id') : $employee->designation->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('designation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('designation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.designation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="employee_type_id">{{ trans('cruds.employee.fields.employee_type') }}</label>
                            <select class="form-control select2" name="employee_type_id" id="employee_type_id" required>
                                @foreach($employee_types as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('employee_type_id') ? old('employee_type_id') : $employee->employee_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.employee_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institution_id">{{ trans('cruds.employee.fields.institution') }}</label>
                            <select class="form-control select2" name="institution_id" id="institution_id" required>
                                @foreach($institutions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('institution_id') ? old('institution_id') : $employee->institution->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('institution'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institution') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.institution_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('frontend.employees.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($employee) && $employee->photo)
      var file = {!! json_encode($employee->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    Dropzone.options.signatureDropzone = {
    url: '{{ route('frontend.employees.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="signature"]').remove()
      $('form').append('<input type="hidden" name="signature" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="signature"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($employee) && $employee->signature)
      var file = {!! json_encode($employee->signature) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="signature" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection