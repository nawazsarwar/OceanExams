@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.partner.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.partners.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.partner.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="product_name">{{ trans('cruds.partner.fields.product_name') }}</label>
                            <input class="form-control" type="text" name="product_name" id="product_name" value="{{ old('product_name', '') }}" required>
                            @if($errors->has('product_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.product_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="logo">{{ trans('cruds.partner.fields.logo') }}</label>
                            <div class="needsclick dropzone" id="logo-dropzone">
                            </div>
                            @if($errors->has('logo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('logo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.logo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="subdomain">{{ trans('cruds.partner.fields.subdomain') }}</label>
                            <input class="form-control" type="text" name="subdomain" id="subdomain" value="{{ old('subdomain', '') }}" required>
                            @if($errors->has('subdomain'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subdomain') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.subdomain_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="hostname">{{ trans('cruds.partner.fields.hostname') }}</label>
                            <input class="form-control" type="text" name="hostname" id="hostname" value="{{ old('hostname', '') }}" required>
                            @if($errors->has('hostname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hostname') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.hostname_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="public_email">{{ trans('cruds.partner.fields.public_email') }}</label>
                            <input class="form-control" type="email" name="public_email" id="public_email" value="{{ old('public_email') }}">
                            @if($errors->has('public_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('public_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.public_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="public_mobile">{{ trans('cruds.partner.fields.public_mobile') }}</label>
                            <input class="form-control" type="text" name="public_mobile" id="public_mobile" value="{{ old('public_mobile', '') }}">
                            @if($errors->has('public_mobile'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('public_mobile') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.public_mobile_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.partner.fields.address') }}</label>
                            <textarea class="form-control" name="address" id="address">{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="header_background_color">{{ trans('cruds.partner.fields.header_background_color') }}</label>
                            <input class="form-control" type="text" name="header_background_color" id="header_background_color" value="{{ old('header_background_color', '') }}">
                            @if($errors->has('header_background_color'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('header_background_color') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.header_background_color_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="footer_background_color">{{ trans('cruds.partner.fields.footer_background_color') }}</label>
                            <input class="form-control" type="text" name="footer_background_color" id="footer_background_color" value="{{ old('footer_background_color', '') }}">
                            @if($errors->has('footer_background_color'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('footer_background_color') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.footer_background_color_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.partner.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Partner::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', 'Active') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.partner.fields.remarks') }}</label>
                            <textarea class="form-control" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.partner.fields.remarks_helper') }}</span>
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
    url: '{{ route('frontend.partners.storeMedia') }}',
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
@if(isset($partner) && $partner->logo)
      var file = {!! json_encode($partner->logo) !!}
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