@extends('layouts.admin')
@section('content')
@can('student_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.students.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.student.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.student.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Student">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.student.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.mobile_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.fathers_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.mothers_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.parents_contact') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.date_of_birth') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.date_of_joining') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.image_verified') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.archived') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.enrollment_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.roll_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.id_card_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.transport_route') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.transport_stop') }}
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
@can('student_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.students.massDestroy') }}",
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
    ajax: "{{ route('admin.students.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'mobile_no', name: 'mobile_no' },
{ data: 'fathers_name', name: 'fathers_name' },
{ data: 'mothers_name', name: 'mothers_name' },
{ data: 'parents_contact', name: 'parents_contact' },
{ data: 'date_of_birth', name: 'date_of_birth' },
{ data: 'date_of_joining', name: 'date_of_joining' },
{ data: 'email', name: 'email' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'image_verified', name: 'image_verified' },
{ data: 'archived', name: 'archived' },
{ data: 'enrollment_no', name: 'enrollment_no' },
{ data: 'roll_no', name: 'roll_no' },
{ data: 'id_card_no', name: 'id_card_no' },
{ data: 'transport_route_name', name: 'transport_route.name' },
{ data: 'transport_stop_name', name: 'transport_stop.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Student').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection