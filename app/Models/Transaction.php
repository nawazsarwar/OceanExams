<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'transactions';

    protected $dates = [
        'due_date',
        'payment_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'student_id',
        'fee_structure_id',
        'institute_id',
        'payable',
        'discount',
        'paid',
        'balance',
        'due_date',
        'payment_date',
        'remark',
        'added_by_id',
        'payment_cycle',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function fee_structure()
    {
        return $this->belongsTo(FeeStructure::class, 'fee_structure_id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }

    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPaymentDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function added_by()
    {
        return $this->belongsTo(User::class, 'added_by_id');
    }
}
