@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.institute.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.institutes.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $institute->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $institute->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.logo') }}
                                    </th>
                                    <td>
                                        @if($institute->logo)
                                            <a href="{{ $institute->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $institute->logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $institute->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.subdomain') }}
                                    </th>
                                    <td>
                                        {{ $institute->subdomain }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.hostname') }}
                                    </th>
                                    <td>
                                        {{ $institute->hostname }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.type') }}
                                    </th>
                                    <td>
                                        {{ $institute->type->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.level') }}
                                    </th>
                                    <td>
                                        {{ $institute->level->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.affiliation') }}
                                    </th>
                                    <td>
                                        @foreach($institute->affiliations as $key => $affiliation)
                                            <span class="label label-info">{{ $affiliation->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.affiliation_no') }}
                                    </th>
                                    <td>
                                        {{ $institute->affiliation_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.template') }}
                                    </th>
                                    <td>
                                        {{ $institute->template }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.latitude') }}
                                    </th>
                                    <td>
                                        {{ $institute->latitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.longitude') }}
                                    </th>
                                    <td>
                                        {{ $institute->longitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.about') }}
                                    </th>
                                    <td>
                                        {{ $institute->about }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.public_email') }}
                                    </th>
                                    <td>
                                        {{ $institute->public_email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.public_mobile') }}
                                    </th>
                                    <td>
                                        {{ $institute->public_mobile }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.partner') }}
                                    </th>
                                    <td>
                                        {{ $institute->partner->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.institutes.index') }}">
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