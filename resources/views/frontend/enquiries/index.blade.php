@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('enquiry_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.enquiries.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.enquiry.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.enquiry.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Enquiry">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.first_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.middle_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.last_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.fathers_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.mothers_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.mobile_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.course') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.class') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.passing_year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.enquiry.fields.message') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enquiries as $key => $enquiry)
                                    <tr data-entry-id="{{ $enquiry->id }}">
                                        <td>
                                            {{ $enquiry->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->middle_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->fathers_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->mothers_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->mobile_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->course->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Enquiry::CLASS_SELECT[$enquiry->class] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->passing_year ?? '' }}
                                        </td>
                                        <td>
                                            {{ $enquiry->message ?? '' }}
                                        </td>
                                        <td>
                                            @can('enquiry_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.enquiries.show', $enquiry->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('enquiry_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.enquiries.edit', $enquiry->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('enquiry_delete')
                                                <form action="{{ route('frontend.enquiries.destroy', $enquiry->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('enquiry_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.enquiries.massDestroy') }}",
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
  let table = $('.datatable-Enquiry:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection