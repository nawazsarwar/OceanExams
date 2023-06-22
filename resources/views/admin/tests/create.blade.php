@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.test.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tests.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ti">{{ trans('cruds.test.fields.ti') }}</label>
                <input class="form-control {{ $errors->has('ti') ? 'is-invalid' : '' }}" type="text" name="ti" id="ti" value="{{ old('ti', '') }}">
                @if($errors->has('ti'))
                    <span class="text-danger">{{ $errors->first('ti') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.test.fields.ti_helper') }}</span>
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