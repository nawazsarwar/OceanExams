@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.partner.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.partners.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.partner.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_name">{{ trans('cruds.partner.fields.product_name') }}</label>
                <input class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" type="text" name="product_name" id="product_name" value="{{ old('product_name', '') }}" required>
                @if($errors->has('product_name'))
                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.product_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prefix">{{ trans('cruds.partner.fields.prefix') }}</label>
                <input class="form-control {{ $errors->has('prefix') ? 'is-invalid' : '' }}" type="text" name="prefix" id="prefix" value="{{ old('prefix', '') }}" required>
                @if($errors->has('prefix'))
                    <span class="text-danger">{{ $errors->first('prefix') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.prefix_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="primary_url">{{ trans('cruds.partner.fields.primary_url') }}</label>
                <input class="form-control {{ $errors->has('primary_url') ? 'is-invalid' : '' }}" type="text" name="primary_url" id="primary_url" value="{{ old('primary_url', '') }}" required>
                @if($errors->has('primary_url'))
                    <span class="text-danger">{{ $errors->first('primary_url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.primary_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="header_logo">{{ trans('cruds.partner.fields.header_logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('header_logo') ? 'is-invalid' : '' }}" id="header_logo-dropzone">
                </div>
                @if($errors->has('header_logo'))
                    <span class="text-danger">{{ $errors->first('header_logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.header_logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="header_background_color">{{ trans('cruds.partner.fields.header_background_color') }}</label>
                <input class="form-control {{ $errors->has('header_background_color') ? 'is-invalid' : '' }}" type="text" name="header_background_color" id="header_background_color" value="{{ old('header_background_color', '') }}">
                @if($errors->has('header_background_color'))
                    <span class="text-danger">{{ $errors->first('header_background_color') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.header_background_color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="footer_background_color">{{ trans('cruds.partner.fields.footer_background_color') }}</label>
                <input class="form-control {{ $errors->has('footer_background_color') ? 'is-invalid' : '' }}" type="text" name="footer_background_color" id="footer_background_color" value="{{ old('footer_background_color', '') }}">
                @if($errors->has('footer_background_color'))
                    <span class="text-danger">{{ $errors->first('footer_background_color') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.footer_background_color_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.partner.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Partner::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'Active') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.partner.fields.remarks') }}</label>
                <textarea class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                @if($errors->has('remarks'))
                    <span class="text-danger">{{ $errors->first('remarks') }}</span>
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



@endsection

@section('scripts')
<script>
    Dropzone.options.headerLogoDropzone = {
    url: '{{ route('admin.partners.storeMedia') }}',
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
      $('form').find('input[name="header_logo"]').remove()
      $('form').append('<input type="hidden" name="header_logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="header_logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($partner) && $partner->header_logo)
      var file = {!! json_encode($partner->header_logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="header_logo" value="' + file.file_name + '">')
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