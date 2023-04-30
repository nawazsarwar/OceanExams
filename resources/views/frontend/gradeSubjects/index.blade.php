@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('grade_subject_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.grade-subjects.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.gradeSubject.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'GradeSubject', 'route' => 'admin.grade-subjects.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.gradeSubject.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-GradeSubject">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.gradeSubject.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.gradeSubject.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.gradeSubject.fields.grade') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.gradeSubject.fields.subject') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.gradeSubject.fields.institute') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gradeSubjects as $key => $gradeSubject)
                                    <tr data-entry-id="{{ $gradeSubject->id }}">
                                        <td>
                                            {{ $gradeSubject->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $gradeSubject->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $gradeSubject->grade->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $gradeSubject->subject->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $gradeSubject->institute->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('grade_subject_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.grade-subjects.show', $gradeSubject->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('grade_subject_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.grade-subjects.edit', $gradeSubject->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('grade_subject_delete')
                                                <form action="{{ route('frontend.grade-subjects.destroy', $gradeSubject->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('grade_subject_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.grade-subjects.massDestroy') }}",
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
  let table = $('.datatable-GradeSubject:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection