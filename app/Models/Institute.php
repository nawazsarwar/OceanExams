<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Institute extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'institutes';

    protected $appends = [
        'logo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'subdomain',
        'hostname',
        'type_id',
        'level_id',
        'affiliation_no',
        'template',
        'latitude',
        'longitude',
        'about',
        'public_email',
        'public_mobile',
        'partner_id',
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

    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function type()
    {
        return $this->belongsTo(InstituteType::class, 'type_id');
    }

    public function level()
    {
        return $this->belongsTo(InstituteLevel::class, 'level_id');
    }

    public function affiliations()
    {
        return $this->belongsToMany(Affiliationer::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
