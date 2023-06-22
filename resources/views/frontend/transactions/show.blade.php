@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.transaction.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.transactions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $transaction->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.student') }}
                                    </th>
                                    <td>
                                        {{ $transaction->student->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.fee_structure') }}
                                    </th>
                                    <td>
                                        {{ $transaction->fee_structure->fee ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.institute') }}
                                    </th>
                                    <td>
                                        {{ $transaction->institute->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.payable') }}
                                    </th>
                                    <td>
                                        {{ $transaction->payable }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.discount') }}
                                    </th>
                                    <td>
                                        {{ $transaction->discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.paid') }}
                                    </th>
                                    <td>
                                        {{ $transaction->paid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.balance') }}
                                    </th>
                                    <td>
                                        {{ $transaction->balance }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.due_date') }}
                                    </th>
                                    <td>
                                        {{ $transaction->due_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.payment_date') }}
                                    </th>
                                    <td>
                                        {{ $transaction->payment_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.remark') }}
                                    </th>
                                    <td>
                                        {{ $transaction->remark }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.added_by') }}
                                    </th>
                                    <td>
                                        {{ $transaction->added_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.payment_cycle') }}
                                    </th>
                                    <td>
                                        {{ $transaction->payment_cycle }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.transactions.index') }}">
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