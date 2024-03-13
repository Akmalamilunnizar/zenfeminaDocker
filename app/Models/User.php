<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
      'usrname', 'email', 'profile_img', 'birthdate', 'password'
    ];

    protected function cycle() :HasMany
    {
        return $this->hasMany(Cycle::class);
    }

    protected function debt() :HasMany
    {
        return $this->hasMany(Debt::class);
    }

    protected function istihadhah() :HasMany
    {
        return $this->hasMany(Istihadhah::class);
    }

    protected function verification() :HasOne
    {
        return $this->hasOne(Verification::class);
    }

    protected function reminder() :HasMany
    {
        return $this->hasMany(Reminder::class);
    }
}
