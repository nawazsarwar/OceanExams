@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.institute.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.institutes.update", [$institute->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.institute.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $institute->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.institute.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $institute->email) }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.email_helper') }}</span>
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
                <label class="required" for="subdomain">{{ trans('cruds.institute.fields.subdomain') }}</label>
                <input class="form-control {{ $errors->has('subdomain') ? 'is-invalid' : '' }}" type="text" name="subdomain" id="subdomain" value="{{ old('subdomain', $institute->subdomain) }}" required>
                @if($errors->has('subdomain'))
                    <span class="text-danger">{{ $errors->first('subdomain') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.subdomain_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hostname">{{ trans('cruds.institute.fields.hostname') }}</label>
                <input class="form-control {{ $errors->has('hostname') ? 'is-invalid' : '' }}" type="text" name="hostname" id="hostname" value="{{ old('hostname', $institute->hostname) }}">
                @if($errors->has('hostname'))
                    <span class="text-danger">{{ $errors->first('hostname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.hostname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_email">{{ trans('cruds.institute.fields.public_email') }}</label>
                <input class="form-control {{ $errors->has('public_email') ? 'is-invalid' : '' }}" type="email" name="public_email" id="public_email" value="{{ old('public_email', $institute->public_email) }}">
                @if($errors->has('public_email'))
                    <span class="text-danger">{{ $errors->first('public_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.public_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_mobile">{{ trans('cruds.institute.fields.public_mobile') }}</label>
                <input class="form-control {{ $errors->has('public_mobile') ? 'is-invalid' : '' }}" type="text" name="public_mobile" id="public_mobile" value="{{ old('public_mobile', $institute->public_mobile) }}">
                @if($errors->has('public_mobile'))
                    <span class="text-danger">{{ $errors->first('public_mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.public_mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.institute.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address', $institute->address) }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="header_background_color">{{ trans('cruds.institute.fields.header_background_color') }}</label>
                <input class="form-control {{ $errors->has('header_background_color') ? 'is-invalid' : '' }}" type="text" name="header_background_color" id="header_background_color" value="{{ old('header_background_color', $institute->header_background_color) }}">
                @if($errors->has('header_background_color'))
                    <span class="text-danger">{{ $errors->first('header_background_color') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.header_background_color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="footer_background_color">{{ trans('cruds.institute.fields.footer_background_color') }}</label>
                <input class="form-control {{ $errors->has('footer_background_color') ? 'is-invalid' : '' }}" type="text" name="footer_background_color" id="footer_background_color" value="{{ old('footer_background_color', $institute->footer_background_color) }}">
                @if($errors->has('footer_background_color'))
                    <span class="text-danger">{{ $errors->first('footer_background_color') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.footer_background_color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="about">{{ trans('cruds.institute.fields.about') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('about') ? 'is-invalid' : '' }}" name="about" id="about">{!! old('about', $institute->about) !!}</textarea>
                @if($errors->has('about'))
                    <span class="text-danger">{{ $errors->first('about') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.about_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type_id">{{ trans('cruds.institute.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id">
                    @foreach($types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('type_id') ? old('type_id') : $institute->type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (old('level_id') ? old('level_id') : $institute->level->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (in_array($id, old('affiliations', [])) || $institute->affiliations->contains($id)) ? 'selected' : '' }}>{{ $affiliation }}</option>
                    @endforeach
                </select>
                @if($errors->has('affiliations'))
                    <span class="text-danger">{{ $errors->first('affiliations') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.affiliation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="affiliation_no">{{ trans('cruds.institute.fields.affiliation_no') }}</label>
                <input class="form-control {{ $errors->has('affiliation_no') ? 'is-invalid' : '' }}" type="text" name="affiliation_no" id="affiliation_no" value="{{ old('affiliation_no', $institute->affiliation_no) }}">
                @if($errors->has('affiliation_no'))
                    <span class="text-danger">{{ $errors->first('affiliation_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.affiliation_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="template">{{ trans('cruds.institute.fields.template') }}</label>
                <input class="form-control {{ $errors->has('template') ? 'is-invalid' : '' }}" type="text" name="template" id="template" value="{{ old('template', $institute->template) }}">
                @if($errors->has('template'))
                    <span class="text-danger">{{ $errors->first('template') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.template_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.institute.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', $institute->latitude) }}">
                @if($errors->has('latitude'))
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.institute.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', $institute->longitude) }}">
                @if($errors->has('longitude'))
                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_id">{{ trans('cruds.institute.fields.partner') }}</label>
                <select class="form-control select2 {{ $errors->has('partner') ? 'is-invalid' : '' }}" name="partner_id" id="partner_id">
                    @foreach($partners as $id => $entry)
                        <option value="{{ $id }}" {{ (old('partner_id') ? old('partner_id') : $institute->partner->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('partner'))
                    <span class="text-danger">{{ $errors->first('partner') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.partner_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.institute.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Institute::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $institute->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.institute.fields.remarks') }}</label>
                <textarea class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" name="remarks" id="remarks">{{ old('remarks', $institute->remarks) }}</textarea>
                @if($errors->has('remarks'))
                    <span class="text-danger">{{ $errors->first('remarks') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.institute.fields.remarks_helper') }}</span>
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
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.institutes.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $institute->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection