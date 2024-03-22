<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'categories_id', 'title', 'content', 'image', 'on_clicked'
    ];

    // Relasi dengan model Category
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
