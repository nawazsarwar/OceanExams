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
                                        {{ trans('cruds.partner.fields.prefix') }}
                                    </th>
                                    <td>
                                        {{ $partner->prefix }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.primary_url') }}
                                    </th>
                                    <td>
                                        {{ $partner->primary_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.partner.fields.header_logo') }}
                                    </th>
                                    <td>
                                        @if($partner->header_logo)
                                            <a href="{{ $partner->header_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $partner->header_logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
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