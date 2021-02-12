<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\QueryBuilder;

use App\Notifications\ResetPassword as ResetPasswordNotification;


class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasSlug, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'country_id',
        'name',
        'slug',
        'phone',
        'gender',
        'about',
        'city',
        'email',
        'password',
    ];
    protected $nullable = [
        'country_id',
        'city',
        'phone',
        'gender',
        'about',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user-images')
             ->acceptsMimeTypes(['image/jpeg', 'image/png'])
             ->onlyKeepLatest(1)
             ->registerMediaConversions(function (Media $media){
                $this->addMediaConversion('thumb')
                     ->width(140)
                     ->height(140);
             });
        $this->addMediaCollection('user-cover-images')
             ->acceptsMimeTypes(['image/jpeg', 'image/png'])
             ->onlyKeepLatest(1);
    }


    public function listing(){
        return $this->hasMany(Listing::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function hotlineMessage(){
        return $this->hasMany(HotlineMessage::class);
    }
    public function subscription(){
        return $this->hasOne(Subscription::class);
    }



    public function isRegularUser(){
        return $this->role_id === 1;
    }

    public function isVip(){
        return $this->role_id >= 2;
    }
    public function isSupporter(){
        return $this->role_id >= 3;
    }
    public function isModerator(){
        return $this->role_id >= 4;
    }
    public function isAdmin(){
        return $this->role_id >= 5;
    }
    public function giveRole($role)
    {
        $this->update(['role_id' => $role]);
    }
    public function removeRoles()
    {
        $this->update(['role_id' => 1]);
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
