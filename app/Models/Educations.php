<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    use HasFactory;
    protected $fillable = [
        'categories_id', 'title', 'content', 'image', 'on_clicked'
    ];

    // Relasi dengan model Category
    public function Categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
