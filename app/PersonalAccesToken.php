<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccesToken extends Model
{
    use HasFactory;
    
     /**
     * @var 
     */
    protected $fillable = [
        'name', 'token', 'abilities', 'last_used_at', 'expires_at'
    ];
}
