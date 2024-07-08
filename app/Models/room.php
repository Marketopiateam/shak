<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function chat()
    {
        return $this->hasMany(chat::class, 'room_id');
    }
    public function trip()
    {
        return $this->hasMany(Order::class, 'trip_id');
    }
    
}
