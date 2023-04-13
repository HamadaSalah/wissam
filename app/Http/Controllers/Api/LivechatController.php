<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Livechat;
use App\Models\Message;
use Illuminate\Http\Request;

class LivechatController extends Controller
{
    public  function get()
    {
        return response()->json(Livechat::where('user_id', auth()->user()->id)->with('messages')->get(), 200);
    }
    public function add(Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);
        $livechat = Livechat::where('user_id', auth()->user()->id)->first();
        $mess = Message::create([
            'message' => $request->message,
            'livechat_id' =>  $livechat->id,
            'user_id' => auth()->user()->id
        ]);
        return response()->json($mess, 200);
    }
}
