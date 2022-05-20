<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function rooms(Request $request){
       return ChatRoom::whereIn('id', function($query)
            {
                $query->select('chat_room_id')
                      ->from('chat_users')
                      ->whereRaw('chat_users.user_id = '.Auth::id());
            })->get();
//        return ChatRoom::select('chat_rooms.*')->join('chat_users', 'chat_rooms.id', '=', 'chat_users.chat_room_id')->whereIn('chat_users.id', '=', Auth::id())->get();
        exit();
    }
    public function messages(Request $request, $roomId){
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function newMessage(Request $request, $roomId){
        $newMessage = new ChatMessage;
        $newMessage->user_id = Auth::id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();
        broadcast(new NewChatMessage($newMessage))->toOthers();
        return $newMessage;
    }
    public function getPrivilages(Request $request, $roomId){
        if(DB::table('chat_users')->select('admin')->where('room_id', $roomId)->where('user_id', Auth::id())){
            return 1;
        }else{
            return 0;
        }
    }

}
