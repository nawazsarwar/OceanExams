@extends('layouts.admin')
@section('content')
@can('omr_based_test_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.omr-based-tests.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.omrBasedTest.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.omrBasedTest.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-OmrBasedTest">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.omrBasedTest.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.omrBasedTest.fields.series') }}
                    </th>
                    <th>
                        {{ trans('cruds.omrBasedTest.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.omrBasedTest.fields.negative_mark') }}
                    </th>
                    <th>
                        {{ trans('cruds.omrBasedTest.fields.correct_mark') }}
                    </th>
                    <th>
                        {{ trans('cruds.omrBasedTest.fields.total_question') }}
                    </th>
                    <th>
                        {{ trans('cruds.omrBasedTest.fields.target_year') }}
                    </th>
                    <th>
                        {{ trans('cruds.omrBasedTest.fields.test_date') }}
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
@can('omr_based_test_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.omr-based-tests.massDestroy') }}",
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
    ajax: "{{ route('admin.omr-based-tests.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'series', name: 'series' },
{ data: 'type', name: 'type' },
{ data: 'negative_mark', name: 'negative_mark' },
{ data: 'correct_mark', name: 'correct_mark' },
{ data: 'total_question', name: 'total_question' },
{ data: 'target_year', name: 'target_year' },
{ data: 'test_date', name: 'test_date' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-OmrBasedTest').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection