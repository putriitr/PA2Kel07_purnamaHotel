<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_category_id',
        'image',
        'price',
        'capacity',
        'facility'
    ];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class);
    }
}
