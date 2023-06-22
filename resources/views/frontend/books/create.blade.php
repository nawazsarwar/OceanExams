@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.book.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.books.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.book.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="author">{{ trans('cruds.book.fields.author') }}</label>
                            <input class="form-control" type="text" name="author" id="author" value="{{ old('author', '') }}">
                            @if($errors->has('author'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('author') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.author_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="edition">{{ trans('cruds.book.fields.edition') }}</label>
                            <input class="form-control" type="text" name="edition" id="edition" value="{{ old('edition', '') }}">
                            @if($errors->has('edition'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('edition') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.edition_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="publisher">{{ trans('cruds.book.fields.publisher') }}</label>
                            <input class="form-control" type="text" name="publisher" id="publisher" value="{{ old('publisher', '') }}">
                            @if($errors->has('publisher'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('publisher') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.publisher_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="isbn">{{ trans('cruds.book.fields.isbn') }}</label>
                            <input class="form-control" type="text" name="isbn" id="isbn" value="{{ old('isbn', '') }}">
                            @if($errors->has('isbn'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('isbn') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.isbn_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="copies">{{ trans('cruds.book.fields.copies') }}</label>
                            <input class="form-control" type="text" name="copies" id="copies" value="{{ old('copies', '') }}">
                            @if($errors->has('copies'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('copies') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.copies_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('cruds.book.fields.price') }}</label>
                            <input class="form-control" type="text" name="price" id="price" value="{{ old('price', '') }}">
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="data">{{ trans('cruds.book.fields.data') }}</label>
                            <textarea class="form-control" name="data" id="data">{{ old('data') }}</textarea>
                            @if($errors->has('data'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('data') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.data_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="subject_id">{{ trans('cruds.book.fields.subject') }}</label>
                            <select class="form-control select2" name="subject_id" id="subject_id">
                                @foreach($subjects as $id => $entry)
                                    <option value="{{ $id }}" {{ old('subject_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subject'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subject') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.subject_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="added_by_id">{{ trans('cruds.book.fields.added_by') }}</label>
                            <select class="form-control select2" name="added_by_id" id="added_by_id" required>
                                @foreach($added_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('added_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('added_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('added_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.added_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cover">{{ trans('cruds.book.fields.cover') }}</label>
                            <div class="needsclick dropzone" id="cover-dropzone">
                            </div>
                            @if($errors->has('cover'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cover') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.book.fields.cover_helper') }}</span>
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
    Dropzone.options.coverDropzone = {
    url: '{{ route('frontend.books.storeMedia') }}',
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
      $('form').find('input[name="cover"]').remove()
      $('form').append('<input type="hidden" name="cover" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="cover"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($book) && $book->cover)
      var file = {!! json_encode($book->cover) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="cover" value="' + file.file_name + '">')
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