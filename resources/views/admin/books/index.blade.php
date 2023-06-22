@extends('layouts.admin')
@section('content')
@can('book_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.books.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.book.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Book', 'route' => 'admin.books.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.book.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Book">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.book.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.author') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.edition') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.publisher') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.isbn') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.copies') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.data') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.subject') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.added_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.book.fields.cover') }}
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
@can('book_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.books.massDestroy') }}",
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
    ajax: "{{ route('admin.books.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'author', name: 'author' },
{ data: 'edition', name: 'edition' },
{ data: 'publisher', name: 'publisher' },
{ data: 'isbn', name: 'isbn' },
{ data: 'copies', name: 'copies' },
{ data: 'price', name: 'price' },
{ data: 'data', name: 'data' },
{ data: 'subject_name', name: 'subject.name' },
{ data: 'added_by_name', name: 'added_by.name' },
{ data: 'cover', name: 'cover', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Book').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection