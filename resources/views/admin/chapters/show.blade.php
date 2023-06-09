@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.chapter.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chapters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.chapter.fields.id') }}
                        </th>
                        <td>
                            {{ $chapter->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chapter.fields.title') }}
                        </th>
                        <td>
                            {{ $chapter->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chapter.fields.status') }}
                        </th>
                        <td>
                            {{ $chapter->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chapter.fields.subject') }}
                        </th>
                        <td>
                            {{ $chapter->subject->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chapters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection