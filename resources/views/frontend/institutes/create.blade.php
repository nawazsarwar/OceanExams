@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.institute.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.institutes.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.institute.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.institute.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="logo">{{ trans('cruds.institute.fields.logo') }}</label>
                            <div class="needsclick dropzone" id="logo-dropzone">
                            </div>
                            @if($errors->has('logo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('logo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.logo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="subdomain">{{ trans('cruds.institute.fields.subdomain') }}</label>
                            <input class="form-control" type="text" name="subdomain" id="subdomain" value="{{ old('subdomain', '') }}" required>
                            @if($errors->has('subdomain'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subdomain') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.subdomain_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hostname">{{ trans('cruds.institute.fields.hostname') }}</label>
                            <input class="form-control" type="text" name="hostname" id="hostname" value="{{ old('hostname', '') }}">
                            @if($errors->has('hostname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hostname') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.hostname_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="public_email">{{ trans('cruds.institute.fields.public_email') }}</label>
                            <input class="form-control" type="email" name="public_email" id="public_email" value="{{ old('public_email') }}">
                            @if($errors->has('public_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('public_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.public_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="public_mobile">{{ trans('cruds.institute.fields.public_mobile') }}</label>
                            <input class="form-control" type="text" name="public_mobile" id="public_mobile" value="{{ old('public_mobile', '') }}">
                            @if($errors->has('public_mobile'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('public_mobile') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.public_mobile_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.institute.fields.address') }}</label>
                            <textarea class="form-control" name="address" id="address">{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="header_background_color">{{ trans('cruds.institute.fields.header_background_color') }}</label>
                            <input class="form-control" type="text" name="header_background_color" id="header_background_color" value="{{ old('header_background_color', '') }}">
                            @if($errors->has('header_background_color'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('header_background_color') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.header_background_color_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="footer_background_color">{{ trans('cruds.institute.fields.footer_background_color') }}</label>
                            <input class="form-control" type="text" name="footer_background_color" id="footer_background_color" value="{{ old('footer_background_color', '') }}">
                            @if($errors->has('footer_background_color'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('footer_background_color') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.footer_background_color_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="about">{{ trans('cruds.institute.fields.about') }}</label>
                            <textarea class="form-control ckeditor" name="about" id="about">{!! old('about') !!}</textarea>
                            @if($errors->has('about'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('about') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.about_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="type_id">{{ trans('cruds.institute.fields.type') }}</label>
                            <select class="form-control select2" name="type_id" id="type_id">
                                @foreach($types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="level_id">{{ trans('cruds.institute.fields.level') }}</label>
                            <select class="form-control select2" name="level_id" id="level_id">
                                @foreach($levels as $id => $entry)
                                    <option value="{{ $id }}" {{ old('level_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('level'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('level') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.level_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="affiliations">{{ trans('cruds.institute.fields.affiliation') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="affiliations[]" id="affiliations" multiple>
                                @foreach($affiliations as $id => $affiliation)
                                    <option value="{{ $id }}" {{ in_array($id, old('affiliations', [])) ? 'selected' : '' }}>{{ $affiliation }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('affiliations'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('affiliations') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.affiliation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="affiliation_no">{{ trans('cruds.institute.fields.affiliation_no') }}</label>
                            <input class="form-control" type="text" name="affiliation_no" id="affiliation_no" value="{{ old('affiliation_no', '') }}">
                            @if($errors->has('affiliation_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('affiliation_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.affiliation_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="template">{{ trans('cruds.institute.fields.template') }}</label>
                            <input class="form-control" type="text" name="template" id="template" value="{{ old('template', '') }}">
                            @if($errors->has('template'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('template') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.template_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="latitude">{{ trans('cruds.institute.fields.latitude') }}</label>
                            <input class="form-control" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                            @if($errors->has('latitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('latitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.latitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="longitude">{{ trans('cruds.institute.fields.longitude') }}</label>
                            <input class="form-control" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                            @if($errors->has('longitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('longitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.longitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="partner_id">{{ trans('cruds.institute.fields.partner') }}</label>
                            <select class="form-control select2" name="partner_id" id="partner_id">
                                @foreach($partners as $id => $entry)
                                    <option value="{{ $id }}" {{ old('partner_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('partner'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('partner') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.partner_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.institute.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Institute::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institute.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.institute.fields.remarks') }}</label>
                            <textarea class="form-control" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('frontend.institutes.storeMedia') }}',
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
                xhr.open('POST', '{{ route('frontend.institutes.storeCKEditorImages') }}', true);
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