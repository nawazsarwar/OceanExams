<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeHead extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'fee_heads';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'Recurring'  => 'Recurring',
        'Occasional' => 'Occasional',
    ];

    protected $fillable = [
        'name',
        'type',
        'recurrence',
        'institute_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
}
