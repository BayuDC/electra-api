<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatController extends Controller {
    public function sendMessage(Request $request, Room $room) {
        $user = Auth::user();

        if ($user->role == 'user' && $room->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'required|string'
        ]);

        $message = new Message();
        $message->room_id = $room->id;
        $message->sender_id = $user->id;
        $message->content = $request->content;
        $message->save();

        broadcast(new MessageSent($message));

        return response()->noContent();
    }

    public function getMessages(Room $room) {
        $user = Auth::user();

        if ($user->role == 'user' && $room->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $messages = Message::where('room_id', $room->id)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json($messages);
    }

    public function createRoom(Request $request) {
        $room = new Room();
        $room->user_id = Auth::id();
        $room->save();

        return response()->json($room);
    }
}
