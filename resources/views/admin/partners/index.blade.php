@extends('layouts.admin')
@section('content')
@can('partner_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.partners.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.partner.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.partner.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Partner">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.product_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.logo') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.subdomain') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.hostname') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.public_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.public_mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.header_background_color') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.footer_background_color') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.partner.fields.remarks') }}
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
@can('partner_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.partners.massDestroy') }}",
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
    ajax: "{{ route('admin.partners.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'product_name', name: 'product_name' },
{ data: 'logo', name: 'logo', sortable: false, searchable: false },
{ data: 'subdomain', name: 'subdomain' },
{ data: 'hostname', name: 'hostname' },
{ data: 'public_email', name: 'public_email' },
{ data: 'public_mobile', name: 'public_mobile' },
{ data: 'address', name: 'address' },
{ data: 'header_background_color', name: 'header_background_color' },
{ data: 'footer_background_color', name: 'footer_background_color' },
{ data: 'status', name: 'status' },
{ data: 'remarks', name: 'remarks' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Partner').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection