<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{room}', function ($user, $room) {
    return $user->role == 'admin' || $room->user_id == $user->id;
});
