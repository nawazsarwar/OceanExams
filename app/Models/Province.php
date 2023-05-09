<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'provinces';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'State'           => 'State',
        'Union Territory' => 'Union Territory',
        'Other'           => 'Other',
    ];

    protected $fillable = [
        'name',
        'iso_3166_2_in',
        'vehicle_code',
        'zone',
        'capital',
        'largest_city',
        'statehood',
        'population',
        'area',
        'official_languages',
        'additional_official_languages',
        'status',
        'remarks',
        'type',
        'country_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
