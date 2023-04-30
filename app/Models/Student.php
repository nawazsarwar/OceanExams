<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Student extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'students';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'date_of_birth',
        'date_of_joining',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'mobile_no',
        'fathers_name',
        'mothers_name',
        'parents_contact',
        'course_id',
        'batch_id',
        'date_of_birth',
        'date_of_joining',
        'email',
        'image_verified',
        'archived',
        'enrollment_no',
        'roll_no',
        'id_card_no',
        'transport_route_id',
        'transport_stop_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateOfJoiningAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfJoiningAttribute($value)
    {
        $this->attributes['date_of_joining'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function transport_route()
    {
        return $this->belongsTo(TransportRoute::class, 'transport_route_id');
    }

    public function transport_stop()
    {
        return $this->belongsTo(RouteStop::class, 'transport_stop_id');
    }
}
