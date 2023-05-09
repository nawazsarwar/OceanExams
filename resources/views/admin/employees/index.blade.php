@extends('layouts.admin')
@section('content')
@can('employee_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.employees.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Employee">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('employee_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employees.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.employees.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'contact', name: 'contact' },
{ data: 'date_of_birth', name: 'date_of_birth' },
{ data: 'gender', name: 'gender' },
{ data: 'photo', name: 'photo', sortable: false, searchable: false },
{ data: 'signature', name: 'signature', sortable: false, searchable: false },
{ data: 'date_of_joining', name: 'date_of_joining' },
{ data: 'subjects', name: 'subjects.name' },
{ data: 'designation_name', name: 'designation.name' },
{ data: 'employee_type_title', name: 'employee_type.title' },
{ data: 'institution_name', name: 'institution.name' },
{ data: 'user_name', name: 'user.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Employee').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection