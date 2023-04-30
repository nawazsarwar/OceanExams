@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.omrBasedTest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.omr-based-tests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.omrBasedTest.fields.id') }}
                        </th>
                        <td>
                            {{ $omrBasedTest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.omrBasedTest.fields.series') }}
                        </th>
                        <td>
                            {{ $omrBasedTest->series }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.omrBasedTest.fields.type') }}
                        </th>
                        <td>
                            {{ $omrBasedTest->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.omrBasedTest.fields.negative_mark') }}
                        </th>
                        <td>
                            {{ $omrBasedTest->negative_mark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.omrBasedTest.fields.correct_mark') }}
                        </th>
                        <td>
                            {{ $omrBasedTest->correct_mark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.omrBasedTest.fields.total_question') }}
                        </th>
                        <td>
                            {{ $omrBasedTest->total_question }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.omrBasedTest.fields.target_year') }}
                        </th>
                        <td>
                            {{ $omrBasedTest->target_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.omrBasedTest.fields.test_date') }}
                        </th>
                        <td>
                            {{ $omrBasedTest->test_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.omr-based-tests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection