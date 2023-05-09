@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employee.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.id') }}
                        </th>
                        <td>
                            {{ $employee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.name') }}
                        </th>
                        <td>
                            {{ $employee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.contact') }}
                        </th>
                        <td>
                            {{ $employee->contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $employee->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Employee::GENDER_SELECT[$employee->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.photo') }}
                        </th>
                        <td>
                            @if($employee->photo)
                                <a href="{{ $employee->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $employee->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.signature') }}
                        </th>
                        <td>
                            @if($employee->signature)
                                <a href="{{ $employee->signature->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $employee->signature->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.date_of_joining') }}
                        </th>
                        <td>
                            {{ $employee->date_of_joining }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.subjects') }}
                        </th>
                        <td>
                            @foreach($employee->subjects as $key => $subjects)
                                <span class="label label-info">{{ $subjects->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.designation') }}
                        </th>
                        <td>
                            {{ $employee->designation->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.employee_type') }}
                        </th>
                        <td>
                            {{ $employee->employee_type->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.institution') }}
                        </th>
                        <td>
                            {{ $employee->institution->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.user') }}
                        </th>
                        <td>
                            {{ $employee->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection