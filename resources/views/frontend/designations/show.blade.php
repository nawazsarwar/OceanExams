@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.designation.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.designations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.designation.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $designation->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.designation.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $designation->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.designation.fields.code') }}
                                    </th>
                                    <td>
                                        {{ $designation->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.designation.fields.pay_grade') }}
                                    </th>
                                    <td>
                                        {{ $designation->pay_grade }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.designation.fields.institution') }}
                                    </th>
                                    <td>
                                        {{ $designation->institution->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.designations.index') }}">
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