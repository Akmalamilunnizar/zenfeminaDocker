<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    public $timestamps = false;
    protected $fillable = [
        'category_id', 'title', 'content', 'image'
    ];

    // Relasi dengan model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
