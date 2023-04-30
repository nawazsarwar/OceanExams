@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.institute.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.institutes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.institute.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.institute.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.institute.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="subdomain">{{ trans('cruds.institute.fields.subdomain') }}</label>
                <input class="form-control {{ $errors->has('subdomain') ? 'is-invalid' : '' }}" type="text" name="subdomain" id="subdomain" value="{{ old('subdomain', '') }}" required>
                @if($errors->has('subdomain'))
                    <span class="text-danger">{{ $errors->first('subdomain') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.subdomain_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hostname">{{ trans('cruds.institute.fields.hostname') }}</label>
                <input class="form-control {{ $errors->has('hostname') ? 'is-invalid' : '' }}" type="text" name="hostname" id="hostname" value="{{ old('hostname', '') }}">
                @if($errors->has('hostname'))
                    <span class="text-danger">{{ $errors->first('hostname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.hostname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type_id">{{ trans('cruds.institute.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id">
                    @foreach($types as $id => $entry)
                        <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="level_id">{{ trans('cruds.institute.fields.level') }}</label>
                <select class="form-control select2 {{ $errors->has('level') ? 'is-invalid' : '' }}" name="level_id" id="level_id">
                    @foreach($levels as $id => $entry)
                        <option value="{{ $id }}" {{ old('level_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('level'))
                    <span class="text-danger">{{ $errors->first('level') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="affiliations">{{ trans('cruds.institute.fields.affiliation') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('affiliations') ? 'is-invalid' : '' }}" name="affiliations[]" id="affiliations" multiple>
                    @foreach($affiliations as $id => $affiliation)
                        <option value="{{ $id }}" {{ in_array($id, old('affiliations', [])) ? 'selected' : '' }}>{{ $affiliation }}</option>
                    @endforeach
                </select>
                @if($errors->has('affiliations'))
                    <span class="text-danger">{{ $errors->first('affiliations') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.affiliation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="affiliation_no">{{ trans('cruds.institute.fields.affiliation_no') }}</label>
                <input class="form-control {{ $errors->has('affiliation_no') ? 'is-invalid' : '' }}" type="text" name="affiliation_no" id="affiliation_no" value="{{ old('affiliation_no', '') }}">
                @if($errors->has('affiliation_no'))
                    <span class="text-danger">{{ $errors->first('affiliation_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.affiliation_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="template">{{ trans('cruds.institute.fields.template') }}</label>
                <input class="form-control {{ $errors->has('template') ? 'is-invalid' : '' }}" type="text" name="template" id="template" value="{{ old('template', '') }}">
                @if($errors->has('template'))
                    <span class="text-danger">{{ $errors->first('template') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.template_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.institute.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                @if($errors->has('latitude'))
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.institute.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                @if($errors->has('longitude'))
                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="about">{{ trans('cruds.institute.fields.about') }}</label>
                <textarea class="form-control {{ $errors->has('about') ? 'is-invalid' : '' }}" name="about" id="about">{{ old('about') }}</textarea>
                @if($errors->has('about'))
                    <span class="text-danger">{{ $errors->first('about') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.about_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_email">{{ trans('cruds.institute.fields.public_email') }}</label>
                <input class="form-control {{ $errors->has('public_email') ? 'is-invalid' : '' }}" type="email" name="public_email" id="public_email" value="{{ old('public_email') }}">
                @if($errors->has('public_email'))
                    <span class="text-danger">{{ $errors->first('public_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.public_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_mobile">{{ trans('cruds.institute.fields.public_mobile') }}</label>
                <input class="form-control {{ $errors->has('public_mobile') ? 'is-invalid' : '' }}" type="text" name="public_mobile" id="public_mobile" value="{{ old('public_mobile', '') }}">
                @if($errors->has('public_mobile'))
                    <span class="text-danger">{{ $errors->first('public_mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.public_mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_id">{{ trans('cruds.institute.fields.partner') }}</label>
                <select class="form-control select2 {{ $errors->has('partner') ? 'is-invalid' : '' }}" name="partner_id" id="partner_id">
                    @foreach($partners as $id => $entry)
                        <option value="{{ $id }}" {{ old('partner_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('partner'))
                    <span class="text-danger">{{ $errors->first('partner') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.partner_helper') }}</span>
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
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.institutes.storeMedia') }}',
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
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($institute) && $institute->logo)
      var file = {!! json_encode($institute->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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