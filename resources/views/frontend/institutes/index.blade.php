@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('institute_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.institutes.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.institute.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Institute', 'route' => 'admin.institutes.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.institute.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Institute">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.institute.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.logo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.subdomain') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.hostname') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.level') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.affiliation') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.affiliation_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.template') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.latitude') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.longitude') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.about') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.public_email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.public_mobile') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.institute.fields.partner') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($institutes as $key => $institute)
                                    <tr data-entry-id="{{ $institute->id }}">
                                        <td>
                                            {{ $institute->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($institute->logo)
                                                <a href="{{ $institute->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $institute->logo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $institute->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->subdomain ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->hostname ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->type->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->level->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($institute->affiliations as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $institute->affiliation_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->template ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->latitude ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->longitude ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->about ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->public_email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->public_mobile ?? '' }}
                                        </td>
                                        <td>
                                            {{ $institute->partner->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('institute_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.institutes.show', $institute->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('institute_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.institutes.edit', $institute->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('institute_delete')
                                                <form action="{{ route('frontend.institutes.destroy', $institute->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('institute_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.institutes.massDestroy') }}",
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
  let table = $('.datatable-Institute:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection