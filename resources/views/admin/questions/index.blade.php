@extends('layouts.admin')
@section('content')
@can('question_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.questions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.question.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Question', 'route' => 'admin.questions.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.question.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Question">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.question.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.institute') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.course') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.affiliationer') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.chapter') }}
                    </th>
                    <th>
                        {{ trans('cruds.chapter.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.paper') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.question_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.no_of_options') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.created_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.verified_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.verified_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.question.fields.remarks') }}
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
@can('question_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.questions.massDestroy') }}",
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
    ajax: "{{ route('admin.questions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'institute_name', name: 'institute.name' },
{ data: 'course_title', name: 'course.title' },
{ data: 'affiliationer_name', name: 'affiliationer.name' },
{ data: 'chapter_title', name: 'chapter.title' },
{ data: 'chapter.title', name: 'chapter.title' },
{ data: 'paper', name: 'paper' },
{ data: 'question_no', name: 'question_no' },
{ data: 'type', name: 'type' },
{ data: 'no_of_options', name: 'no_of_options' },
{ data: 'status', name: 'status' },
{ data: 'created_by_name', name: 'created_by.name' },
{ data: 'verified_by_name', name: 'verified_by.name' },
{ data: 'verified_at', name: 'verified_at' },
{ data: 'remarks', name: 'remarks' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Question').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection