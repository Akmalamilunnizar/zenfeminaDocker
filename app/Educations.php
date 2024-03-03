<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    use HasFactory;

    protected $table = 'education'; // Sesuaikan dengan nama tabel

    protected $fillable = ['categories_id', 'title', 'content', 'image', 'on_clicked']; // Kolom yang dapat diisi

    // Relasi dengan model Category
    public function Categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
