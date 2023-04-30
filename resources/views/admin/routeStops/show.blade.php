@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.routeStop.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.route-stops.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.routeStop.fields.id') }}
                        </th>
                        <td>
                            {{ $routeStop->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.routeStop.fields.name') }}
                        </th>
                        <td>
                            {{ $routeStop->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.routeStop.fields.transport_route') }}
                        </th>
                        <td>
                            {{ $routeStop->transport_route->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.routeStop.fields.fare') }}
                        </th>
                        <td>
                            {{ $routeStop->fare }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.route-stops.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection