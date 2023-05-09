@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.markAttendance.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.mark-attendances.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.markAttendance.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $markAttendance->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.markAttendance.fields.institute') }}
                                    </th>
                                    <td>
                                        {{ $markAttendance->institute->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.markAttendance.fields.section') }}
                                    </th>
                                    <td>
                                        {{ $markAttendance->section->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.markAttendance.fields.students') }}
                                    </th>
                                    <td>
                                        {{ $markAttendance->students }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.markAttendance.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $markAttendance->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.markAttendance.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $markAttendance->user->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.mark-attendances.index') }}">
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