@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.feesStructure.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fees-structures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.feesStructure.fields.id') }}
                        </th>
                        <td>
                            {{ $feesStructure->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feesStructure.fields.course') }}
                        </th>
                        <td>
                            {{ $feesStructure->course->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feesStructure.fields.batch') }}
                        </th>
                        <td>
                            {{ $feesStructure->batch->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feesStructure.fields.fee') }}
                        </th>
                        <td>
                            {{ $feesStructure->fee }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fees-structures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection