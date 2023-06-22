@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('fee_structure_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.fee-structures.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.feeStructure.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.feeStructure.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-FeeStructure">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.feeStructure.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.feeStructure.fields.fee_head') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.feeStructure.fields.fee') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.feeStructure.fields.institute') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.feeStructure.fields.course') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feeStructures as $key => $feeStructure)
                                    <tr data-entry-id="{{ $feeStructure->id }}">
                                        <td>
                                            {{ $feeStructure->id ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($feeStructure->fee_heads as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $feeStructure->fee ?? '' }}
                                        </td>
                                        <td>
                                            {{ $feeStructure->institute->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $feeStructure->course->title ?? '' }}
                                        </td>
                                        <td>
                                            @can('fee_structure_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.fee-structures.show', $feeStructure->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('fee_structure_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.fee-structures.edit', $feeStructure->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('fee_structure_delete')
                                                <form action="{{ route('frontend.fee-structures.destroy', $feeStructure->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('fee_structure_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.fee-structures.massDestroy') }}",
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
  let table = $('.datatable-FeeStructure:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection