@extends('layouts.admin')
@section('content')
@can('transaction_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transactions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transaction.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transaction.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Transaction">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.student') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.fee_structure') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.institute') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.payable') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.paid') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.balance') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.due_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.payment_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.remark') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.added_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.transaction.fields.payment_cycle') }}
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
@can('transaction_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transactions.massDestroy') }}",
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
    ajax: "{{ route('admin.transactions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'student_name', name: 'student.name' },
{ data: 'fee_structure_fee', name: 'fee_structure.fee' },
{ data: 'institute_name', name: 'institute.name' },
{ data: 'payable', name: 'payable' },
{ data: 'discount', name: 'discount' },
{ data: 'paid', name: 'paid' },
{ data: 'balance', name: 'balance' },
{ data: 'due_date', name: 'due_date' },
{ data: 'payment_date', name: 'payment_date' },
{ data: 'remark', name: 'remark' },
{ data: 'added_by_name', name: 'added_by.name' },
{ data: 'payment_cycle', name: 'payment_cycle' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Transaction').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection