@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.phone.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.phones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.phone.fields.id') }}
                        </th>
                        <td>
                            {{ $phone->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.phone.fields.number') }}
                        </th>
                        <td>
                            {{ $phone->number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.phone.fields.user') }}
                        </th>
                        <td>
                            {{ $phone->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.phone.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\Phone::CATEGORY_SELECT[$phone->category] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.phone.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Phone::TYPE_SELECT[$phone->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.phone.fields.dailing_code') }}
                        </th>
                        <td>
                            {{ $phone->dailing_code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.phones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection