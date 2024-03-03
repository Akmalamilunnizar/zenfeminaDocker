<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
      'title', 'content', 'image', 'on_clicked', 'category_id'
    ];

    protected function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
