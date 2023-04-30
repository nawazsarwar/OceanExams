@extends('layouts.admin')
@section('content')
@can('institute_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.institutes.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Institute">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('institute_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.institutes.massDestroy') }}",
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
    ajax: "{{ route('admin.institutes.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'logo', name: 'logo', sortable: false, searchable: false },
{ data: 'email', name: 'email' },
{ data: 'subdomain', name: 'subdomain' },
{ data: 'hostname', name: 'hostname' },
{ data: 'type_title', name: 'type.title' },
{ data: 'level_name', name: 'level.name' },
{ data: 'affiliation', name: 'affiliations.name' },
{ data: 'affiliation_no', name: 'affiliation_no' },
{ data: 'template', name: 'template' },
{ data: 'latitude', name: 'latitude' },
{ data: 'longitude', name: 'longitude' },
{ data: 'about', name: 'about' },
{ data: 'public_email', name: 'public_email' },
{ data: 'public_mobile', name: 'public_mobile' },
{ data: 'partner_name', name: 'partner.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Institute').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection