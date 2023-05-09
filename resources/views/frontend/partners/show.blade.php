@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.partner.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.partners.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $partner->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $partner->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.product_name') }}
                                    </th>
                                    <td>
                                        {{ $partner->product_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.logo') }}
                                    </th>
                                    <td>
                                        @if($partner->logo)
                                            <a href="{{ $partner->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $partner->logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.subdomain') }}
                                    </th>
                                    <td>
                                        {{ $partner->subdomain }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.hostname') }}
                                    </th>
                                    <td>
                                        {{ $partner->hostname }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.public_email') }}
                                    </th>
                                    <td>
                                        {{ $partner->public_email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.public_mobile') }}
                                    </th>
                                    <td>
                                        {{ $partner->public_mobile }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $partner->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.header_background_color') }}
                                    </th>
                                    <td>
                                        {{ $partner->header_background_color }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.footer_background_color') }}
                                    </th>
                                    <td>
                                        {{ $partner->footer_background_color }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Partner::STATUS_SELECT[$partner->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.remarks') }}
                                    </th>
                                    <td>
                                        {{ $partner->remarks }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.partners.index') }}">
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