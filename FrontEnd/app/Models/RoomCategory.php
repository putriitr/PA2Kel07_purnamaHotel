<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;
    protected $table = 'roomcategories';

    protected $fillable = ['name'];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
