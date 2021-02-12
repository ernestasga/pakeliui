<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HotlineMessage extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'slug',
        'message',
        'vip',
    ];
    protected $nullable = [
        'vip',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('message')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(){
        return 'slug';
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hotline-images')
             ->acceptsMimeTypes(['image/jpeg', 'image/png'])
             ->onlyKeepLatest(config('limits.hotline_max_images'))
             ->registerMediaConversions(function (Media $media){
                $this->addMediaConversion('thumb')
                     ->width(140)
                     ->height(140);

             });

    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
