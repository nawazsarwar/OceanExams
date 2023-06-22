@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('transaction_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.transactions.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($transactions as $key => $transaction)
                                    <tr data-entry-id="{{ $transaction->id }}">
                                        <td>
                                            {{ $transaction->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->student->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->fee_structure->fee ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->institute->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->payable ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->discount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->paid ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->balance ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->due_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->payment_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->remark ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->added_by->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transaction->payment_cycle ?? '' }}
                                        </td>
                                        <td>
                                            @can('transaction_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.transactions.show', $transaction->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('transaction_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.transactions.edit', $transaction->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('transaction_delete')
                                                <form action="{{ route('frontend.transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('transaction_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.transactions.massDestroy') }}",
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
  let table = $('.datatable-Transaction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection