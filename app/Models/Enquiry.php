<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'enquiries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CLASS_SELECT = [
        'X'       => 'X',
        'XII'     => 'XII',
        'Diploma' => 'Diploma',
    ];

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'fathers_name',
        'mothers_name',
        'mobile_no',
        'email',
        'course_id',
        'class',
        'passing_year',
        'message',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
