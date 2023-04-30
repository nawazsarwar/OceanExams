@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.student.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.students.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.id') }}
                        </th>
                        <td>
                            {{ $student->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.first_name') }}
                        </th>
                        <td>
                            {{ $student->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $student->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.last_name') }}
                        </th>
                        <td>
                            {{ $student->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.mobile_no') }}
                        </th>
                        <td>
                            {{ $student->mobile_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.fathers_name') }}
                        </th>
                        <td>
                            {{ $student->fathers_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.mothers_name') }}
                        </th>
                        <td>
                            {{ $student->mothers_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.parents_contact') }}
                        </th>
                        <td>
                            {{ $student->parents_contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.course') }}
                        </th>
                        <td>
                            {{ $student->course->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.batch') }}
                        </th>
                        <td>
                            {{ $student->batch->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $student->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.date_of_joining') }}
                        </th>
                        <td>
                            {{ $student->date_of_joining }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.email') }}
                        </th>
                        <td>
                            {{ $student->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.image') }}
                        </th>
                        <td>
                            @if($student->image)
                                <a href="{{ $student->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $student->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.image_verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $student->image_verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.archived') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $student->archived ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.enrollment_no') }}
                        </th>
                        <td>
                            {{ $student->enrollment_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.roll_no') }}
                        </th>
                        <td>
                            {{ $student->roll_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.id_card_no') }}
                        </th>
                        <td>
                            {{ $student->id_card_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.transport_route') }}
                        </th>
                        <td>
                            {{ $student->transport_route->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.transport_stop') }}
                        </th>
                        <td>
                            {{ $student->transport_stop->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.students.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection