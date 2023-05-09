@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.student.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.students.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="first_name">{{ trans('cruds.student.fields.first_name') }}</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                            @if($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">{{ trans('cruds.student.fields.middle_name') }}</label>
                            <input class="form-control" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                            @if($errors->has('middle_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('middle_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.middle_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ trans('cruds.student.fields.last_name') }}</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}">
                            @if($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.last_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="mobile_no">{{ trans('cruds.student.fields.mobile_no') }}</label>
                            <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', '') }}" required>
                            @if($errors->has('mobile_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.mobile_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fathers_name">{{ trans('cruds.student.fields.fathers_name') }}</label>
                            <input class="form-control" type="text" name="fathers_name" id="fathers_name" value="{{ old('fathers_name', '') }}">
                            @if($errors->has('fathers_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fathers_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.fathers_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mothers_name">{{ trans('cruds.student.fields.mothers_name') }}</label>
                            <input class="form-control" type="text" name="mothers_name" id="mothers_name" value="{{ old('mothers_name', '') }}">
                            @if($errors->has('mothers_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mothers_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.mothers_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="parents_contact">{{ trans('cruds.student.fields.parents_contact') }}</label>
                            <input class="form-control" type="text" name="parents_contact" id="parents_contact" value="{{ old('parents_contact', '') }}" required>
                            @if($errors->has('parents_contact'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('parents_contact') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.parents_contact_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date_of_birth">{{ trans('cruds.student.fields.date_of_birth') }}</label>
                            <input class="form-control date" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            @if($errors->has('date_of_birth'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_of_birth') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.date_of_birth_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date_of_joining">{{ trans('cruds.student.fields.date_of_joining') }}</label>
                            <input class="form-control date" type="text" name="date_of_joining" id="date_of_joining" value="{{ old('date_of_joining') }}" required>
                            @if($errors->has('date_of_joining'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_of_joining') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.date_of_joining_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.student.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="image">{{ trans('cruds.student.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="image_verified" id="image_verified" value="1" required {{ old('image_verified', 0) == 1 ? 'checked' : '' }}>
                                <label class="required" for="image_verified">{{ trans('cruds.student.fields.image_verified') }}</label>
                            </div>
                            @if($errors->has('image_verified'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image_verified') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.image_verified_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="archived" value="0">
                                <input type="checkbox" name="archived" id="archived" value="1" {{ old('archived', 0) == 1 ? 'checked' : '' }}>
                                <label for="archived">{{ trans('cruds.student.fields.archived') }}</label>
                            </div>
                            @if($errors->has('archived'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('archived') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.archived_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="enrollment_no">{{ trans('cruds.student.fields.enrollment_no') }}</label>
                            <input class="form-control" type="text" name="enrollment_no" id="enrollment_no" value="{{ old('enrollment_no', '') }}">
                            @if($errors->has('enrollment_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('enrollment_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.enrollment_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="roll_no">{{ trans('cruds.student.fields.roll_no') }}</label>
                            <input class="form-control" type="text" name="roll_no" id="roll_no" value="{{ old('roll_no', '') }}">
                            @if($errors->has('roll_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('roll_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.roll_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="id_card_no">{{ trans('cruds.student.fields.id_card_no') }}</label>
                            <input class="form-control" type="text" name="id_card_no" id="id_card_no" value="{{ old('id_card_no', '') }}">
                            @if($errors->has('id_card_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_card_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.id_card_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="transport_route_id">{{ trans('cruds.student.fields.transport_route') }}</label>
                            <select class="form-control select2" name="transport_route_id" id="transport_route_id">
                                @foreach($transport_routes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('transport_route_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('transport_route'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transport_route') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.transport_route_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="transport_stop_id">{{ trans('cruds.student.fields.transport_stop') }}</label>
                            <select class="form-control select2" name="transport_stop_id" id="transport_stop_id">
                                @foreach($transport_stops as $id => $entry)
                                    <option value="{{ $id }}" {{ old('transport_stop_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('transport_stop'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transport_stop') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.transport_stop_helper') }}</span>
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('frontend.students.storeMedia') }}',
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
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($student) && $student->image)
      var file = {!! json_encode($student->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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