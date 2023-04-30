@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.gradeSubject.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.grade-subjects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.gradeSubject.fields.id') }}
                        </th>
                        <td>
                            {{ $gradeSubject->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gradeSubject.fields.title') }}
                        </th>
                        <td>
                            {{ $gradeSubject->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gradeSubject.fields.grade') }}
                        </th>
                        <td>
                            {{ $gradeSubject->grade->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gradeSubject.fields.subject') }}
                        </th>
                        <td>
                            {{ $gradeSubject->subject->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gradeSubject.fields.institute') }}
                        </th>
                        <td>
                            {{ $gradeSubject->institute->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.grade-subjects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection