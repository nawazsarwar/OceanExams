@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('issue_book_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.issue-books.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.issueBook.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.issueBook.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-IssueBook">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.issueBook.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.issueBook.fields.book') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.issueBook.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.issueBook.fields.issue_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.issueBook.fields.return_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.issueBook.fields.remarks') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.issueBook.fields.issued_by') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($issueBooks as $key => $issueBook)
                                    <tr data-entry-id="{{ $issueBook->id }}">
                                        <td>
                                            {{ $issueBook->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $issueBook->book->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $issueBook->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $issueBook->issue_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $issueBook->return_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $issueBook->remarks ?? '' }}
                                        </td>
                                        <td>
                                            {{ $issueBook->issued_by->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('issue_book_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.issue-books.show', $issueBook->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('issue_book_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.issue-books.edit', $issueBook->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('issue_book_delete')
                                                <form action="{{ route('frontend.issue-books.destroy', $issueBook->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('issue_book_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.issue-books.massDestroy') }}",
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
  let table = $('.datatable-IssueBook:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection