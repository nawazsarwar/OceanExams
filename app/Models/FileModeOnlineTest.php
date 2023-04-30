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
class FileModeOnlineTest extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const MODE_RADIO = [
        'Questions Database' => 'Questions Database',
        'File Mode'          => 'File Mode',
    ];

    public $table = 'file_mode_online_tests';

    protected $dates = [
        'test_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'quiz',
        'mode',
        'type',
        'test_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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
