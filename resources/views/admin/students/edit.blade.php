@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.students.update", [$student->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.student.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $student->first_name) }}" required>
                @if($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.student.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $student->middle_name) }}">
                @if($errors->has('middle_name'))
                    <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('cruds.student.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $student->last_name) }}">
                @if($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobile_no">{{ trans('cruds.student.fields.mobile_no') }}</label>
                <input class="form-control {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', $student->mobile_no) }}" required>
                @if($errors->has('mobile_no'))
                    <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.mobile_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fathers_name">{{ trans('cruds.student.fields.fathers_name') }}</label>
                <input class="form-control {{ $errors->has('fathers_name') ? 'is-invalid' : '' }}" type="text" name="fathers_name" id="fathers_name" value="{{ old('fathers_name', $student->fathers_name) }}">
                @if($errors->has('fathers_name'))
                    <span class="text-danger">{{ $errors->first('fathers_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.fathers_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mothers_name">{{ trans('cruds.student.fields.mothers_name') }}</label>
                <input class="form-control {{ $errors->has('mothers_name') ? 'is-invalid' : '' }}" type="text" name="mothers_name" id="mothers_name" value="{{ old('mothers_name', $student->mothers_name) }}">
                @if($errors->has('mothers_name'))
                    <span class="text-danger">{{ $errors->first('mothers_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.mothers_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parents_contact">{{ trans('cruds.student.fields.parents_contact') }}</label>
                <input class="form-control {{ $errors->has('parents_contact') ? 'is-invalid' : '' }}" type="text" name="parents_contact" id="parents_contact" value="{{ old('parents_contact', $student->parents_contact) }}">
                @if($errors->has('parents_contact'))
                    <span class="text-danger">{{ $errors->first('parents_contact') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.parents_contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_of_birth">{{ trans('cruds.student.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}" required>
                @if($errors->has('date_of_birth'))
                    <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_joining">{{ trans('cruds.student.fields.date_of_joining') }}</label>
                <input class="form-control date {{ $errors->has('date_of_joining') ? 'is-invalid' : '' }}" type="text" name="date_of_joining" id="date_of_joining" value="{{ old('date_of_joining', $student->date_of_joining) }}">
                @if($errors->has('date_of_joining'))
                    <span class="text-danger">{{ $errors->first('date_of_joining') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.date_of_joining_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.student.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('image_verified') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="image_verified" value="0">
                    <input class="form-check-input" type="checkbox" name="image_verified" id="image_verified" value="1" {{ $student->image_verified || old('image_verified', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="image_verified">{{ trans('cruds.student.fields.image_verified') }}</label>
                </div>
                @if($errors->has('image_verified'))
                    <span class="text-danger">{{ $errors->first('image_verified') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.image_verified_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('archived') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="archived" value="0">
                    <input class="form-check-input" type="checkbox" name="archived" id="archived" value="1" {{ $student->archived || old('archived', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="archived">{{ trans('cruds.student.fields.archived') }}</label>
                </div>
                @if($errors->has('archived'))
                    <span class="text-danger">{{ $errors->first('archived') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.archived_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="enrollment_no">{{ trans('cruds.student.fields.enrollment_no') }}</label>
                <input class="form-control {{ $errors->has('enrollment_no') ? 'is-invalid' : '' }}" type="text" name="enrollment_no" id="enrollment_no" value="{{ old('enrollment_no', $student->enrollment_no) }}">
                @if($errors->has('enrollment_no'))
                    <span class="text-danger">{{ $errors->first('enrollment_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.enrollment_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="roll_no">{{ trans('cruds.student.fields.roll_no') }}</label>
                <input class="form-control {{ $errors->has('roll_no') ? 'is-invalid' : '' }}" type="text" name="roll_no" id="roll_no" value="{{ old('roll_no', $student->roll_no) }}">
                @if($errors->has('roll_no'))
                    <span class="text-danger">{{ $errors->first('roll_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.roll_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_card_no">{{ trans('cruds.student.fields.id_card_no') }}</label>
                <input class="form-control {{ $errors->has('id_card_no') ? 'is-invalid' : '' }}" type="text" name="id_card_no" id="id_card_no" value="{{ old('id_card_no', $student->id_card_no) }}">
                @if($errors->has('id_card_no'))
                    <span class="text-danger">{{ $errors->first('id_card_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.id_card_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sections">{{ trans('cruds.student.fields.section') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('sections') ? 'is-invalid' : '' }}" name="sections[]" id="sections" multiple required>
                    @foreach($sections as $id => $section)
                        <option value="{{ $id }}" {{ (in_array($id, old('sections', [])) || $student->sections->contains($id)) ? 'selected' : '' }}>{{ $section }}</option>
                    @endforeach
                </select>
                @if($errors->has('sections'))
                    <span class="text-danger">{{ $errors->first('sections') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.section_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="users">{{ trans('cruds.student.fields.user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (in_array($id, old('users', [])) || $student->users->contains($id)) ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <span class="text-danger">{{ $errors->first('users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transport_route_id">{{ trans('cruds.student.fields.transport_route') }}</label>
                <select class="form-control select2 {{ $errors->has('transport_route') ? 'is-invalid' : '' }}" name="transport_route_id" id="transport_route_id">
                    @foreach($transport_routes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('transport_route_id') ? old('transport_route_id') : $student->transport_route->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('transport_route'))
                    <span class="text-danger">{{ $errors->first('transport_route') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.transport_route_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transport_stop_id">{{ trans('cruds.student.fields.transport_stop') }}</label>
                <select class="form-control select2 {{ $errors->has('transport_stop') ? 'is-invalid' : '' }}" name="transport_stop_id" id="transport_stop_id">
                    @foreach($transport_stops as $id => $entry)
                        <option value="{{ $id }}" {{ (old('transport_stop_id') ? old('transport_stop_id') : $student->transport_stop->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('transport_stop'))
                    <span class="text-danger">{{ $errors->first('transport_stop') }}</span>
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



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.students.storeMedia') }}',
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