@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.partner.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.partners.update", [$partner->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.partner.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $partner->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_name">{{ trans('cruds.partner.fields.product_name') }}</label>
                <input class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" type="text" name="product_name" id="product_name" value="{{ old('product_name', $partner->product_name) }}" required>
                @if($errors->has('product_name'))
                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.product_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.partner.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="subdomain">{{ trans('cruds.partner.fields.subdomain') }}</label>
                <input class="form-control {{ $errors->has('subdomain') ? 'is-invalid' : '' }}" type="text" name="subdomain" id="subdomain" value="{{ old('subdomain', $partner->subdomain) }}" required>
                @if($errors->has('subdomain'))
                    <span class="text-danger">{{ $errors->first('subdomain') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.subdomain_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hostname">{{ trans('cruds.partner.fields.hostname') }}</label>
                <input class="form-control {{ $errors->has('hostname') ? 'is-invalid' : '' }}" type="text" name="hostname" id="hostname" value="{{ old('hostname', $partner->hostname) }}" required>
                @if($errors->has('hostname'))
                    <span class="text-danger">{{ $errors->first('hostname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.hostname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_email">{{ trans('cruds.partner.fields.public_email') }}</label>
                <input class="form-control {{ $errors->has('public_email') ? 'is-invalid' : '' }}" type="email" name="public_email" id="public_email" value="{{ old('public_email', $partner->public_email) }}">
                @if($errors->has('public_email'))
                    <span class="text-danger">{{ $errors->first('public_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.public_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_mobile">{{ trans('cruds.partner.fields.public_mobile') }}</label>
                <input class="form-control {{ $errors->has('public_mobile') ? 'is-invalid' : '' }}" type="text" name="public_mobile" id="public_mobile" value="{{ old('public_mobile', $partner->public_mobile) }}">
                @if($errors->has('public_mobile'))
                    <span class="text-danger">{{ $errors->first('public_mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.public_mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.partner.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address', $partner->address) }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="header_background_color">{{ trans('cruds.partner.fields.header_background_color') }}</label>
                <input class="form-control {{ $errors->has('header_background_color') ? 'is-invalid' : '' }}" type="text" name="header_background_color" id="header_background_color" value="{{ old('header_background_color', $partner->header_background_color) }}">
                @if($errors->has('header_background_color'))
                    <span class="text-danger">{{ $errors->first('header_background_color') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.header_background_color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="footer_background_color">{{ trans('cruds.partner.fields.footer_background_color') }}</label>
                <input class="form-control {{ $errors->has('footer_background_color') ? 'is-invalid' : '' }}" type="text" name="footer_background_color" id="footer_background_color" value="{{ old('footer_background_color', $partner->footer_background_color) }}">
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
                        <option value="{{ $key }}" {{ old('status', $partner->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.partner.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.partner.fields.remarks') }}</label>
                <textarea class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" name="remarks" id="remarks">{{ old('remarks', $partner->remarks) }}</textarea>
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
    Dropzone.options.logoDropzone = {
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