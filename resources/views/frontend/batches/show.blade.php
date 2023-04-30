@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.batch.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.batches.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batch.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $batch->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batch.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $batch->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batch.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $batch->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batch.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $batch->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batch.fields.target_date') }}
                                    </th>
                                    <td>
                                        {{ $batch->target_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batch.fields.course') }}
                                    </th>
                                    <td>
                                        {{ $batch->course->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batch.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Batch::TYPE_SELECT[$batch->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batch.fields.timing') }}
                                    </th>
                                    <td>
                                        {{ $batch->timing }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batch.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Batch::STATUS_SELECT[$batch->status] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.batches.index') }}">
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