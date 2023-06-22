@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.issueBook.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.issue-books.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="book_id">{{ trans('cruds.issueBook.fields.book') }}</label>
                <select class="form-control select2 {{ $errors->has('book') ? 'is-invalid' : '' }}" name="book_id" id="book_id" required>
                    @foreach($books as $id => $entry)
                        <option value="{{ $id }}" {{ old('book_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('book'))
                    <span class="text-danger">{{ $errors->first('book') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.issueBook.fields.book_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.issueBook.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.issueBook.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="issue_date">{{ trans('cruds.issueBook.fields.issue_date') }}</label>
                <input class="form-control datetime {{ $errors->has('issue_date') ? 'is-invalid' : '' }}" type="text" name="issue_date" id="issue_date" value="{{ old('issue_date') }}">
                @if($errors->has('issue_date'))
                    <span class="text-danger">{{ $errors->first('issue_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.issueBook.fields.issue_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="return_date">{{ trans('cruds.issueBook.fields.return_date') }}</label>
                <input class="form-control datetime {{ $errors->has('return_date') ? 'is-invalid' : '' }}" type="text" name="return_date" id="return_date" value="{{ old('return_date') }}" required>
                @if($errors->has('return_date'))
                    <span class="text-danger">{{ $errors->first('return_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.issueBook.fields.return_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.issueBook.fields.remarks') }}</label>
                <textarea class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                @if($errors->has('remarks'))
                    <span class="text-danger">{{ $errors->first('remarks') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.issueBook.fields.remarks_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="issued_by_id">{{ trans('cruds.issueBook.fields.issued_by') }}</label>
                <select class="form-control select2 {{ $errors->has('issued_by') ? 'is-invalid' : '' }}" name="issued_by_id" id="issued_by_id" required>
                    @foreach($issued_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('issued_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('issued_by'))
                    <span class="text-danger">{{ $errors->first('issued_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.issueBook.fields.issued_by_helper') }}</span>
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