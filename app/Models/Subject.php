<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'subjects';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'status',
        'remarks',
        'institute_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'Draft'     => 'Draft',
        'Pending'   => 'Pending',
        'Published' => 'Published',
        'Withdrawn' => 'Withdrawn',
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
