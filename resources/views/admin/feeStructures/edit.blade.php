@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.feeStructure.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fee-structures.update", [$feeStructure->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="fee_heads">{{ trans('cruds.feeStructure.fields.fee_head') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('fee_heads') ? 'is-invalid' : '' }}" name="fee_heads[]" id="fee_heads" multiple>
                    @foreach($fee_heads as $id => $fee_head)
                        <option value="{{ $id }}" {{ (in_array($id, old('fee_heads', [])) || $feeStructure->fee_heads->contains($id)) ? 'selected' : '' }}>{{ $fee_head }}</option>
                    @endforeach
                </select>
                @if($errors->has('fee_heads'))
                    <span class="text-danger">{{ $errors->first('fee_heads') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.feeStructure.fields.fee_head_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fee">{{ trans('cruds.feeStructure.fields.fee') }}</label>
                <textarea class="form-control {{ $errors->has('fee') ? 'is-invalid' : '' }}" name="fee" id="fee">{{ old('fee', $feeStructure->fee) }}</textarea>
                @if($errors->has('fee'))
                    <span class="text-danger">{{ $errors->first('fee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.feeStructure.fields.fee_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection