<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'expires_at',
    ];
    protected $casts = [
        'expires_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }

}
