<?php

namespace App\Models;

use Carbon\Carbon; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'image', 'username', 'email', 'birthDate', 'password', 'fcm_token'
    ];

    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthDate)->age;
    }

    public function cycle(): HasMany
    {
        return $this->hasMany(Cycle::class);
    }

    public function debt(): HasMany 
    {
        return $this->hasMany(Debt::class);
    }

    public function istihadhah(): HasMany 
    {
        return $this->hasMany(Istihadhah::class);
    }

    public function verification(): HasOne 
    {
        return $this->hasOne(Verification::class);
    }

    public function reminder(): HasMany 
    {
        return $this->hasMany(Reminder::class);
    }
}
