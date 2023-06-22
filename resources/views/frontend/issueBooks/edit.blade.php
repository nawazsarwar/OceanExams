@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.issueBook.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.issue-books.update", [$issueBook->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="book_id">{{ trans('cruds.issueBook.fields.book') }}</label>
                            <select class="form-control select2" name="book_id" id="book_id" required>
                                @foreach($books as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('book_id') ? old('book_id') : $issueBook->book->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('book'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('book') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.issueBook.fields.book_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.issueBook.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $issueBook->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.issueBook.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="issue_date">{{ trans('cruds.issueBook.fields.issue_date') }}</label>
                            <input class="form-control datetime" type="text" name="issue_date" id="issue_date" value="{{ old('issue_date', $issueBook->issue_date) }}">
                            @if($errors->has('issue_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('issue_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.issueBook.fields.issue_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="return_date">{{ trans('cruds.issueBook.fields.return_date') }}</label>
                            <input class="form-control datetime" type="text" name="return_date" id="return_date" value="{{ old('return_date', $issueBook->return_date) }}" required>
                            @if($errors->has('return_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('return_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.issueBook.fields.return_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.issueBook.fields.remarks') }}</label>
                            <textarea class="form-control" name="remarks" id="remarks">{{ old('remarks', $issueBook->remarks) }}</textarea>
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.issueBook.fields.remarks_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="issued_by_id">{{ trans('cruds.issueBook.fields.issued_by') }}</label>
                            <select class="form-control select2" name="issued_by_id" id="issued_by_id" required>
                                @foreach($issued_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('issued_by_id') ? old('issued_by_id') : $issueBook->issued_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('issued_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('issued_by') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection