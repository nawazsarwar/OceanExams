@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('route_stop_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.route-stops.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.routeStop.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'RouteStop', 'route' => 'admin.route-stops.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.routeStop.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-RouteStop">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.routeStop.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.routeStop.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.routeStop.fields.transport_route') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.routeStop.fields.fare') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($routeStops as $key => $routeStop)
                                    <tr data-entry-id="{{ $routeStop->id }}">
                                        <td>
                                            {{ $routeStop->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $routeStop->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $routeStop->transport_route->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $routeStop->fare ?? '' }}
                                        </td>
                                        <td>
                                            @can('route_stop_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.route-stops.show', $routeStop->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('route_stop_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.route-stops.edit', $routeStop->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('route_stop_delete')
                                                <form action="{{ route('frontend.route-stops.destroy', $routeStop->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('route_stop_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.route-stops.massDestroy') }}",
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
  let table = $('.datatable-RouteStop:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection