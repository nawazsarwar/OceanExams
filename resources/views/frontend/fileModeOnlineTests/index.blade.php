@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('file_mode_online_test_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.file-mode-online-tests.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.fileModeOnlineTest.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.fileModeOnlineTest.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-FileModeOnlineTest">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.quiz') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.mode') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.fileModeOnlineTest.fields.test_date') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fileModeOnlineTests as $key => $fileModeOnlineTest)
                                    <tr data-entry-id="{{ $fileModeOnlineTest->id }}">
                                        <td>
                                            {{ $fileModeOnlineTest->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $fileModeOnlineTest->quiz ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\FileModeOnlineTest::MODE_RADIO[$fileModeOnlineTest->mode] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $fileModeOnlineTest->type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $fileModeOnlineTest->test_date ?? '' }}
                                        </td>
                                        <td>
                                            @can('file_mode_online_test_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.file-mode-online-tests.show', $fileModeOnlineTest->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('file_mode_online_test_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.file-mode-online-tests.edit', $fileModeOnlineTest->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('file_mode_online_test_delete')
                                                <form action="{{ route('frontend.file-mode-online-tests.destroy', $fileModeOnlineTest->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('file_mode_online_test_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.file-mode-online-tests.massDestroy') }}",
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
  let table = $('.datatable-FileModeOnlineTest:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection