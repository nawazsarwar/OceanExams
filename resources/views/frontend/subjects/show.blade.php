@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.subject.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.subjects.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subject.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $subject->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subject.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $subject->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subject.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Subject::STATUS_SELECT[$subject->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subject.fields.remarks') }}
                                    </th>
                                    <td>
                                        {{ $subject->remarks }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subject.fields.institute') }}
                                    </th>
                                    <td>
                                        {{ $subject->institute->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.subjects.index') }}">
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