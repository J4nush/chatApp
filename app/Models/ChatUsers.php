<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUsers extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function assingToDefaults($user_id){
        $general = ChatUsers::create([
            'chat_room_id' => 1,
            'user_id' => $user_id,
            'blocked' => 0,
            'admin' =>0
        ]);
        $general->save();
        $tech = ChatUsers::create([
            'chat_room_id' => 2,
            'user_id' => $user_id,
            'blocked' => 0,
            'admin' =>0
        ]);
        $tech->save();
        $other = ChatUsers::create([
            'chat_room_id' => 3,
            'user_id' => $user_id,
            'blocked' => 0,
            'admin' =>0
        ]);
        $other->save();
        return 1;
    }
}
