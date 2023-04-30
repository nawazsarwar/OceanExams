@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.fileModeOnlineTest.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.file-mode-online-tests.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $fileModeOnlineTest->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.quiz') }}
                                    </th>
                                    <td>
                                        {{ $fileModeOnlineTest->quiz }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.mode') }}
                                    </th>
                                    <td>
                                        {{ App\Models\FileModeOnlineTest::MODE_RADIO[$fileModeOnlineTest->mode] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.type') }}
                                    </th>
                                    <td>
                                        {{ $fileModeOnlineTest->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.test_date') }}
                                    </th>
                                    <td>
                                        {{ $fileModeOnlineTest->test_date }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.file-mode-online-tests.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection