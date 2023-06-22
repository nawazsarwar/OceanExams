@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('ledger_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.ledgers.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.ledger.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.ledger.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Ledger">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ledger.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.student') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.fee_structure') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.institute') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.payable') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.discount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.paid') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.balance') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.due_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.payment_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.remark') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.added_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ledger.fields.payment_cycle') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ledgers as $key => $ledger)
                                    <tr data-entry-id="{{ $ledger->id }}">
                                        <td>
                                            {{ $ledger->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->student->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->fee_structure->fee ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->institute->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->payable ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->discount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->paid ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->balance ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->due_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->payment_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->remark ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->added_by->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ledger->payment_cycle ?? '' }}
                                        </td>
                                        <td>
                                            @can('ledger_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.ledgers.show', $ledger->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('ledger_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.ledgers.edit', $ledger->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('ledger_delete')
                                                <form action="{{ route('frontend.ledgers.destroy', $ledger->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('ledger_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.ledgers.massDestroy') }}",
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
  let table = $('.datatable-Ledger:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection