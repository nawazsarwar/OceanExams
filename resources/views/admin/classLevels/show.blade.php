@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.classLevel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.class-levels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.classLevel.fields.id') }}
                        </th>
                        <td>
                            {{ $classLevel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classLevel.fields.title') }}
                        </th>
                        <td>
                            {{ $classLevel->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classLevel.fields.institute') }}
                        </th>
                        <td>
                            {{ $classLevel->institute->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.class-levels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection