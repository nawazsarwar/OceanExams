<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @internal
 * @coversNothing
 */
class OmrBasedTest extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'omr_based_tests';

    protected $dates = [
        'target_year',
        'test_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'series',
        'type',
        'negative_mark',
        'correct_mark',
        'total_question',
        'target_year',
        'test_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTargetYearAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTargetYearAttribute($value)
    {
        $this->attributes['target_year'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getTestDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTestDateAttribute($value)
    {
        $this->attributes['test_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
