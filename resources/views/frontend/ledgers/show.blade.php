@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.ledger.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.ledgers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $ledger->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.student') }}
                                    </th>
                                    <td>
                                        {{ $ledger->student->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.fee_structure') }}
                                    </th>
                                    <td>
                                        {{ $ledger->fee_structure->fee ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.institute') }}
                                    </th>
                                    <td>
                                        {{ $ledger->institute->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.payable') }}
                                    </th>
                                    <td>
                                        {{ $ledger->payable }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.discount') }}
                                    </th>
                                    <td>
                                        {{ $ledger->discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.paid') }}
                                    </th>
                                    <td>
                                        {{ $ledger->paid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.balance') }}
                                    </th>
                                    <td>
                                        {{ $ledger->balance }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.due_date') }}
                                    </th>
                                    <td>
                                        {{ $ledger->due_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.payment_date') }}
                                    </th>
                                    <td>
                                        {{ $ledger->payment_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.remark') }}
                                    </th>
                                    <td>
                                        {{ $ledger->remark }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.added_by') }}
                                    </th>
                                    <td>
                                        {{ $ledger->added_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.payment_cycle') }}
                                    </th>
                                    <td>
                                        {{ $ledger->payment_cycle }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.ledgers.index') }}">
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