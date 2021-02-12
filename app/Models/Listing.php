<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Listing extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'country_id',
        'slug',
        'from',
        'to',
        'departure',
        'type',
        'seats',
        'price',
        'phone',
        'note',
        'vip',
        'currency',
    ];
    protected $nullable = [
        'seats',
        'price',
        'note',
        'vip',
        'currency',
    ];
    protected $casts = [
        'departure' => 'datetime',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['from', 'to'])
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function registerMediaCollections(): void
    {

        $this->addMediaCollection('uploaded-images')
             ->acceptsMimeTypes(['image/jpeg', 'image/png'])
             ->onlyKeepLatest(1)
             ->registerMediaConversions(function (Media $media){
                $this->addMediaConversion('thumb')
                     ->width(200);
             });
    }

    public function scopeDepartureFrom($query, $date)
    {
        return $query->where('departure', '>=', Carbon::parse($date));
    }
    public function scopeDepartureTo($query, $date)
    {
        return $query->where('departure', '<=', Carbon::parse($date));
    }


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }

}
