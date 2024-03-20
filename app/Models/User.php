<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use HasFactory, HasRoles;
    public $timestamps = false;

    protected $fillable = [
      'username', 'email', 'profile_img', 'birthDate', 'password'
    ];

    public function getAgeAttribute(){
        return Carbon::parse($this->birthDate)->age;
    }

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

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthIdentifier()
    {
        return $this->email;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->token;
    }

    public function setRememberToken($value)
    {
        $this->token = $value;
    }

    public function getRememberTokenName()
    {
        return 'token';
    }
}
