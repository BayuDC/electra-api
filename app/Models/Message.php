<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Message extends Model {
    use HasFactory;

    protected $fillable = ['content', 'sender_id', 'room_id'];

    public function room() {
        return $this->belongsTo(Room::class);
    }
}
