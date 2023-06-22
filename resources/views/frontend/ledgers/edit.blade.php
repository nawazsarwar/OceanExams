@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.ledger.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.ledgers.update", [$ledger->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="student_id">{{ trans('cruds.ledger.fields.student') }}</label>
                            <select class="form-control select2" name="student_id" id="student_id" required>
                                @foreach($students as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $ledger->student->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('student'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('student') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.student_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="fee_structure_id">{{ trans('cruds.ledger.fields.fee_structure') }}</label>
                            <select class="form-control select2" name="fee_structure_id" id="fee_structure_id" required>
                                @foreach($fee_structures as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('fee_structure_id') ? old('fee_structure_id') : $ledger->fee_structure->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('fee_structure'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fee_structure') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.fee_structure_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institute_id">{{ trans('cruds.ledger.fields.institute') }}</label>
                            <select class="form-control select2" name="institute_id" id="institute_id" required>
                                @foreach($institutes as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('institute_id') ? old('institute_id') : $ledger->institute->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('institute'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institute') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.institute_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="payable">{{ trans('cruds.ledger.fields.payable') }}</label>
                            <input class="form-control" type="number" name="payable" id="payable" value="{{ old('payable', $ledger->payable) }}" step="0.01" required>
                            @if($errors->has('payable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.payable_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="discount">{{ trans('cruds.ledger.fields.discount') }}</label>
                            <input class="form-control" type="number" name="discount" id="discount" value="{{ old('discount', $ledger->discount) }}" step="0.01" required>
                            @if($errors->has('discount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('discount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.discount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="paid">{{ trans('cruds.ledger.fields.paid') }}</label>
                            <input class="form-control" type="number" name="paid" id="paid" value="{{ old('paid', $ledger->paid) }}" step="0.01" required>
                            @if($errors->has('paid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('paid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.paid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="balance">{{ trans('cruds.ledger.fields.balance') }}</label>
                            <input class="form-control" type="number" name="balance" id="balance" value="{{ old('balance', $ledger->balance) }}" step="0.01" required>
                            @if($errors->has('balance'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('balance') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.balance_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="due_date">{{ trans('cruds.ledger.fields.due_date') }}</label>
                            <input class="form-control date" type="text" name="due_date" id="due_date" value="{{ old('due_date', $ledger->due_date) }}" required>
                            @if($errors->has('due_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('due_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.due_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="payment_date">{{ trans('cruds.ledger.fields.payment_date') }}</label>
                            <input class="form-control date" type="text" name="payment_date" id="payment_date" value="{{ old('payment_date', $ledger->payment_date) }}" required>
                            @if($errors->has('payment_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.payment_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remark">{{ trans('cruds.ledger.fields.remark') }}</label>
                            <textarea class="form-control" name="remark" id="remark">{{ old('remark', $ledger->remark) }}</textarea>
                            @if($errors->has('remark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.remark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="added_by_id">{{ trans('cruds.ledger.fields.added_by') }}</label>
                            <select class="form-control select2" name="added_by_id" id="added_by_id" required>
                                @foreach($added_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('added_by_id') ? old('added_by_id') : $ledger->added_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('added_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('added_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.added_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="payment_cycle">{{ trans('cruds.ledger.fields.payment_cycle') }}</label>
                            <input class="form-control" type="number" name="payment_cycle" id="payment_cycle" value="{{ old('payment_cycle', $ledger->payment_cycle) }}" step="1" required>
                            @if($errors->has('payment_cycle'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_cycle') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ledger.fields.payment_cycle_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection