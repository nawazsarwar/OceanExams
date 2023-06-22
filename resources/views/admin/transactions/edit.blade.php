@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.transaction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transactions.update", [$transaction->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="student_id">{{ trans('cruds.transaction.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id" required>
                    @foreach($students as $id => $entry)
                        <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $transaction->student->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <span class="text-danger">{{ $errors->first('student') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.student_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fee_structure_id">{{ trans('cruds.transaction.fields.fee_structure') }}</label>
                <select class="form-control select2 {{ $errors->has('fee_structure') ? 'is-invalid' : '' }}" name="fee_structure_id" id="fee_structure_id" required>
                    @foreach($fee_structures as $id => $entry)
                        <option value="{{ $id }}" {{ (old('fee_structure_id') ? old('fee_structure_id') : $transaction->fee_structure->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fee_structure'))
                    <span class="text-danger">{{ $errors->first('fee_structure') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.fee_structure_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="institute_id">{{ trans('cruds.transaction.fields.institute') }}</label>
                <select class="form-control select2 {{ $errors->has('institute') ? 'is-invalid' : '' }}" name="institute_id" id="institute_id" required>
                    @foreach($institutes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('institute_id') ? old('institute_id') : $transaction->institute->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('institute'))
                    <span class="text-danger">{{ $errors->first('institute') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.institute_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payable">{{ trans('cruds.transaction.fields.payable') }}</label>
                <input class="form-control {{ $errors->has('payable') ? 'is-invalid' : '' }}" type="number" name="payable" id="payable" value="{{ old('payable', $transaction->payable) }}" step="0.01" required>
                @if($errors->has('payable'))
                    <span class="text-danger">{{ $errors->first('payable') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.payable_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="discount">{{ trans('cruds.transaction.fields.discount') }}</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', $transaction->discount) }}" step="0.01" required>
                @if($errors->has('discount'))
                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="paid">{{ trans('cruds.transaction.fields.paid') }}</label>
                <input class="form-control {{ $errors->has('paid') ? 'is-invalid' : '' }}" type="number" name="paid" id="paid" value="{{ old('paid', $transaction->paid) }}" step="0.01" required>
                @if($errors->has('paid'))
                    <span class="text-danger">{{ $errors->first('paid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="balance">{{ trans('cruds.transaction.fields.balance') }}</label>
                <input class="form-control {{ $errors->has('balance') ? 'is-invalid' : '' }}" type="number" name="balance" id="balance" value="{{ old('balance', $transaction->balance) }}" step="0.01" required>
                @if($errors->has('balance'))
                    <span class="text-danger">{{ $errors->first('balance') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="due_date">{{ trans('cruds.transaction.fields.due_date') }}</label>
                <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date', $transaction->due_date) }}" required>
                @if($errors->has('due_date'))
                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.due_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payment_date">{{ trans('cruds.transaction.fields.payment_date') }}</label>
                <input class="form-control date {{ $errors->has('payment_date') ? 'is-invalid' : '' }}" type="text" name="payment_date" id="payment_date" value="{{ old('payment_date', $transaction->payment_date) }}" required>
                @if($errors->has('payment_date'))
                    <span class="text-danger">{{ $errors->first('payment_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.payment_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.transaction.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark', $transaction->remark) }}</textarea>
                @if($errors->has('remark'))
                    <span class="text-danger">{{ $errors->first('remark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.remark_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="added_by_id">{{ trans('cruds.transaction.fields.added_by') }}</label>
                <select class="form-control select2 {{ $errors->has('added_by') ? 'is-invalid' : '' }}" name="added_by_id" id="added_by_id" required>
                    @foreach($added_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('added_by_id') ? old('added_by_id') : $transaction->added_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('added_by'))
                    <span class="text-danger">{{ $errors->first('added_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.added_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payment_cycle">{{ trans('cruds.transaction.fields.payment_cycle') }}</label>
                <input class="form-control {{ $errors->has('payment_cycle') ? 'is-invalid' : '' }}" type="number" name="payment_cycle" id="payment_cycle" value="{{ old('payment_cycle', $transaction->payment_cycle) }}" step="1" required>
                @if($errors->has('payment_cycle'))
                    <span class="text-danger">{{ $errors->first('payment_cycle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.payment_cycle_helper') }}</span>
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