<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galeries';
    protected $fillable = ['name', 'description', 'category_id', 'image'];

    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }
}
