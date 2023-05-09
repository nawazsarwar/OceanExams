@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.feeHead.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.fee-heads.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.feeHead.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $feeHead->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.feeHead.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $feeHead->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.feeHead.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\FeeHead::TYPE_SELECT[$feeHead->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.feeHead.fields.recurrence') }}
                                    </th>
                                    <td>
                                        {{ $feeHead->recurrence }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.feeHead.fields.institute') }}
                                    </th>
                                    <td>
                                        {{ $feeHead->institute->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.fee-heads.index') }}">
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