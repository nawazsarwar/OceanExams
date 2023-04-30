<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GradeSubject extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'grade_subjects';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'grade_id',
        'subject_id',
        'institute_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
}
