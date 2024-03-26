<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    public $timestamps = false;
    protected $fillable = [
        'categories_id', 'title', 'content', 'image', 'on_clicked'
    ];

    // Relasi dengan model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
