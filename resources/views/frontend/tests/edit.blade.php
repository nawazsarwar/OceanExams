@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.test.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.tests.update", [$test->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="ti">{{ trans('cruds.test.fields.ti') }}</label>
                            <input class="form-control" type="text" name="ti" id="ti" value="{{ old('ti', $test->ti) }}">
                            @if($errors->has('ti'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ti') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection