@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('employee_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.employees.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.employee.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Employee', 'route' => 'admin.employees.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.employee.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Employee">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.contact') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.date_of_birth') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.gender') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.photo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.signature') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.date_of_joining') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.subjects') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.designation') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.employee_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.institution') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.user') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $key => $employee)
                                    <tr data-entry-id="{{ $employee->id }}">
                                        <td>
                                            {{ $employee->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->contact ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->date_of_birth ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Employee::GENDER_SELECT[$employee->gender] ?? '' }}
                                        </td>
                                        <td>
                                            @if($employee->photo)
                                                <a href="{{ $employee->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $employee->photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($employee->signature)
                                                <a href="{{ $employee->signature->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $employee->signature->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $employee->date_of_joining ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($employee->subjects as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $employee->designation->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->employee_type->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->institution->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->user->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('employee_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.employees.show', $employee->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('employee_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.employees.edit', $employee->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('employee_delete')
                                                <form action="{{ route('frontend.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('employee_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.employees.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Employee:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection