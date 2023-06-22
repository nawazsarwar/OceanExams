@extends('layouts.admin')
@section('content')
@can('enquiry_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.enquiries.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.enquiry.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.enquiry.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Enquiry">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.middle_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.fathers_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.mothers_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.mobile_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.course') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.class') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.passing_year') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiry.fields.message') }}
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
@can('enquiry_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.enquiries.massDestroy') }}",
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
    ajax: "{{ route('admin.enquiries.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'first_name', name: 'first_name' },
{ data: 'middle_name', name: 'middle_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'fathers_name', name: 'fathers_name' },
{ data: 'mothers_name', name: 'mothers_name' },
{ data: 'mobile_no', name: 'mobile_no' },
{ data: 'email', name: 'email' },
{ data: 'course_title', name: 'course.title' },
{ data: 'class', name: 'class' },
{ data: 'passing_year', name: 'passing_year' },
{ data: 'message', name: 'message' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Enquiry').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection