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

    public const STATUS_SELECT = [
        'Draft'     => 'Draft',
        'Pending'   => 'Pending',
        'Published' => 'Published',
        'Withdrawn' => 'Withdrawn',
    ];

    protected $fillable = [
        'name',
        'category',
        'status',
        'remarks',
        'institute_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CATEGORY_SELECT = [
        'Major'            => 'Major',
        'Minor'            => 'Minor',
        'Generic Elective' => 'Generic Elective',
        'Open Elective'    => 'Open Elective',
        'Vocational'       => 'Vocational',
        'Value Added'      => 'Value Added',
        'Research'         => 'Research',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }
}
