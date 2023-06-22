@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.transaction.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.transactions.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="student_id">{{ trans('cruds.transaction.fields.student') }}</label>
                            <select class="form-control select2" name="student_id" id="student_id" required>
                                @foreach($students as $id => $entry)
                                    <option value="{{ $id }}" {{ old('student_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('student'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('student') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.student_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="fee_structure_id">{{ trans('cruds.transaction.fields.fee_structure') }}</label>
                            <select class="form-control select2" name="fee_structure_id" id="fee_structure_id" required>
                                @foreach($fee_structures as $id => $entry)
                                    <option value="{{ $id }}" {{ old('fee_structure_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('fee_structure'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fee_structure') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.fee_structure_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institute_id">{{ trans('cruds.transaction.fields.institute') }}</label>
                            <select class="form-control select2" name="institute_id" id="institute_id" required>
                                @foreach($institutes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('institute_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('institute'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institute') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.institute_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="payable">{{ trans('cruds.transaction.fields.payable') }}</label>
                            <input class="form-control" type="number" name="payable" id="payable" value="{{ old('payable', '') }}" step="0.01" required>
                            @if($errors->has('payable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.payable_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="discount">{{ trans('cruds.transaction.fields.discount') }}</label>
                            <input class="form-control" type="number" name="discount" id="discount" value="{{ old('discount', '') }}" step="0.01" required>
                            @if($errors->has('discount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('discount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.discount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="paid">{{ trans('cruds.transaction.fields.paid') }}</label>
                            <input class="form-control" type="number" name="paid" id="paid" value="{{ old('paid', '') }}" step="0.01" required>
                            @if($errors->has('paid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('paid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.paid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="balance">{{ trans('cruds.transaction.fields.balance') }}</label>
                            <input class="form-control" type="number" name="balance" id="balance" value="{{ old('balance', '') }}" step="0.01" required>
                            @if($errors->has('balance'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('balance') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.balance_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="due_date">{{ trans('cruds.transaction.fields.due_date') }}</label>
                            <input class="form-control date" type="text" name="due_date" id="due_date" value="{{ old('due_date') }}" required>
                            @if($errors->has('due_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('due_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.due_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="payment_date">{{ trans('cruds.transaction.fields.payment_date') }}</label>
                            <input class="form-control date" type="text" name="payment_date" id="payment_date" value="{{ old('payment_date') }}" required>
                            @if($errors->has('payment_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.payment_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remark">{{ trans('cruds.transaction.fields.remark') }}</label>
                            <textarea class="form-control" name="remark" id="remark">{{ old('remark') }}</textarea>
                            @if($errors->has('remark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.remark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="added_by_id">{{ trans('cruds.transaction.fields.added_by') }}</label>
                            <select class="form-control select2" name="added_by_id" id="added_by_id" required>
                                @foreach($added_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('added_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('added_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('added_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.added_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="payment_cycle">{{ trans('cruds.transaction.fields.payment_cycle') }}</label>
                            <input class="form-control" type="number" name="payment_cycle" id="payment_cycle" value="{{ old('payment_cycle', '') }}" step="1" required>
                            @if($errors->has('payment_cycle'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_cycle') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection