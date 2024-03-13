<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'password_reset_tokens';

    /**
     *@var bool
     */
    public $timestamps = false;

    /**

     * @var array
     */
    protected $fillable = [
        'email', 'token', 'created_at'
    ];
}
