<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $table = 'gallerycategories';

    // Tentukan kolom yang bisa diisi
    protected $fillable = ['name'];

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
