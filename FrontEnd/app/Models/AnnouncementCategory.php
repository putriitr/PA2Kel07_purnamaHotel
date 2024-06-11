<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementCategory extends Model
{
    use HasFactory;

    // Tentukan tabel jika nama tabel tidak sesuai dengan konvensi
    protected $table = 'announcementcategories';

    // Tentukan kolom yang bisa diisi
    protected $fillable = ['name'];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
