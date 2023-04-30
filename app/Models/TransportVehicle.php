<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportVehicle extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'transport_vehicles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'driver_id',
        'assistant_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function driver()
    {
        return $this->belongsTo(Employee::class, 'driver_id');
    }

    public function assistant()
    {
        return $this->belongsTo(Employee::class, 'assistant_id');
    }
}
