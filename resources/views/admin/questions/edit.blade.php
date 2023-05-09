@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.questions.update", [$question->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="institute_id">{{ trans('cruds.question.fields.institute') }}</label>
                <select class="form-control select2 {{ $errors->has('institute') ? 'is-invalid' : '' }}" name="institute_id" id="institute_id" required>
                    @foreach($institutes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('institute_id') ? old('institute_id') : $question->institute->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('institute'))
                    <span class="text-danger">{{ $errors->first('institute') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.institute_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="course_id">{{ trans('cruds.question.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id">
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $question->course->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <span class="text-danger">{{ $errors->first('course') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="affiliationer_id">{{ trans('cruds.question.fields.affiliationer') }}</label>
                <select class="form-control select2 {{ $errors->has('affiliationer') ? 'is-invalid' : '' }}" name="affiliationer_id" id="affiliationer_id">
                    @foreach($affiliationers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('affiliationer_id') ? old('affiliationer_id') : $question->affiliationer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('affiliationer'))
                    <span class="text-danger">{{ $errors->first('affiliationer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.affiliationer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="chapter_id">{{ trans('cruds.question.fields.chapter') }}</label>
                <select class="form-control select2 {{ $errors->has('chapter') ? 'is-invalid' : '' }}" name="chapter_id" id="chapter_id" required>
                    @foreach($chapters as $id => $entry)
                        <option value="{{ $id }}" {{ (old('chapter_id') ? old('chapter_id') : $question->chapter->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('chapter'))
                    <span class="text-danger">{{ $errors->first('chapter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.chapter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="paper">{{ trans('cruds.question.fields.paper') }}</label>
                <input class="form-control {{ $errors->has('paper') ? 'is-invalid' : '' }}" type="text" name="paper" id="paper" value="{{ old('paper', $question->paper) }}">
                @if($errors->has('paper'))
                    <span class="text-danger">{{ $errors->first('paper') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.paper_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_no">{{ trans('cruds.question.fields.question_no') }}</label>
                <input class="form-control {{ $errors->has('question_no') ? 'is-invalid' : '' }}" type="text" name="question_no" id="question_no" value="{{ old('question_no', $question->question_no) }}">
                @if($errors->has('question_no'))
                    <span class="text-danger">{{ $errors->first('question_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.question.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $question->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.question.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Question::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $question->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_of_options">{{ trans('cruds.question.fields.no_of_options') }}</label>
                <input class="form-control {{ $errors->has('no_of_options') ? 'is-invalid' : '' }}" type="number" name="no_of_options" id="no_of_options" value="{{ old('no_of_options', $question->no_of_options) }}" step="1">
                @if($errors->has('no_of_options'))
                    <span class="text-danger">{{ $errors->first('no_of_options') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.no_of_options_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="option_1">{{ trans('cruds.question.fields.option_1') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('option_1') ? 'is-invalid' : '' }}" name="option_1" id="option_1">{!! old('option_1', $question->option_1) !!}</textarea>
                @if($errors->has('option_1'))
                    <span class="text-danger">{{ $errors->first('option_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.option_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="option_2">{{ trans('cruds.question.fields.option_2') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('option_2') ? 'is-invalid' : '' }}" name="option_2" id="option_2">{!! old('option_2', $question->option_2) !!}</textarea>
                @if($errors->has('option_2'))
                    <span class="text-danger">{{ $errors->first('option_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.option_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="option_3">{{ trans('cruds.question.fields.option_3') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('option_3') ? 'is-invalid' : '' }}" name="option_3" id="option_3">{!! old('option_3', $question->option_3) !!}</textarea>
                @if($errors->has('option_3'))
                    <span class="text-danger">{{ $errors->first('option_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.option_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="option_4">{{ trans('cruds.question.fields.option_4') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('option_4') ? 'is-invalid' : '' }}" name="option_4" id="option_4">{!! old('option_4', $question->option_4) !!}</textarea>
                @if($errors->has('option_4'))
                    <span class="text-danger">{{ $errors->first('option_4') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.option_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="option_5">{{ trans('cruds.question.fields.option_5') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('option_5') ? 'is-invalid' : '' }}" name="option_5" id="option_5">{!! old('option_5', $question->option_5) !!}</textarea>
                @if($errors->has('option_5'))
                    <span class="text-danger">{{ $errors->first('option_5') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.option_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="option_6">{{ trans('cruds.question.fields.option_6') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('option_6') ? 'is-invalid' : '' }}" name="option_6" id="option_6">{!! old('option_6', $question->option_6) !!}</textarea>
                @if($errors->has('option_6'))
                    <span class="text-danger">{{ $errors->first('option_6') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.option_6_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="correct_option">{{ trans('cruds.question.fields.correct_option') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('correct_option') ? 'is-invalid' : '' }}" name="correct_option" id="correct_option">{!! old('correct_option', $question->correct_option) !!}</textarea>
                @if($errors->has('correct_option'))
                    <span class="text-danger">{{ $errors->first('correct_option') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.correct_option_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.question.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Question::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $question->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="created_by_id">{{ trans('cruds.question.fields.created_by') }}</label>
                <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by_id" id="created_by_id" required>
                    @foreach($created_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('created_by_id') ? old('created_by_id') : $question->created_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('created_by'))
                    <span class="text-danger">{{ $errors->first('created_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.created_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="verified_by_id">{{ trans('cruds.question.fields.verified_by') }}</label>
                <select class="form-control select2 {{ $errors->has('verified_by') ? 'is-invalid' : '' }}" name="verified_by_id" id="verified_by_id">
                    @foreach($verified_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('verified_by_id') ? old('verified_by_id') : $question->verified_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('verified_by'))
                    <span class="text-danger">{{ $errors->first('verified_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.verified_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="verified_at">{{ trans('cruds.question.fields.verified_at') }}</label>
                <input class="form-control datetime {{ $errors->has('verified_at') ? 'is-invalid' : '' }}" type="text" name="verified_at" id="verified_at" value="{{ old('verified_at', $question->verified_at) }}">
                @if($errors->has('verified_at'))
                    <span class="text-danger">{{ $errors->first('verified_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.verified_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.question.fields.remarks') }}</label>
                <textarea class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" name="remarks" id="remarks">{{ old('remarks', $question->remarks) }}</textarea>
                @if($errors->has('remarks'))
                    <span class="text-danger">{{ $errors->first('remarks') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.remarks_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.questions.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $question->id ?? 0 }}');
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