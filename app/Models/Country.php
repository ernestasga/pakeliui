<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
    public function listing(){
        return $this->hasMany(Listing::class);
    }

}
