<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'cycle_length', 'period_length', 'start_date', 'end_date', 'user_id'
    ];

    protected function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
