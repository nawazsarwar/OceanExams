@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.feeStructure.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fee-structures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.feeStructure.fields.id') }}
                        </th>
                        <td>
                            {{ $feeStructure->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feeStructure.fields.fee_head') }}
                        </th>
                        <td>
                            @foreach($feeStructure->fee_heads as $key => $fee_head)
                                <span class="label label-info">{{ $fee_head->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feeStructure.fields.fee') }}
                        </th>
                        <td>
                            {{ $feeStructure->fee }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feeStructure.fields.institute') }}
                        </th>
                        <td>
                            {{ $feeStructure->institute->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feeStructure.fields.course') }}
                        </th>
                        <td>
                            {{ $feeStructure->course->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fee-structures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection