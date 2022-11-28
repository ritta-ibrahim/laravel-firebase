<?php

namespace App\Http\Controllers;

use App\Helpers\FirebaseHelper;
use App\Models\User;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    public function send()
    {
        $FcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
        $result =
        FirebaseHelper::sendMessageLegacy(
            serverKey:'<YOUR-SERVER-KEY>',
            userFcmTokens:$FcmTokens,
            notification:[
                "title" => 'My Title',
                "body" => 'My Notification Body',
            ],
            data:[
                "key1" => "value1",
                "key2" => "value2",
                "key3" => "value3",
            ]
        );

        return view('dashboard', compact('result'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $user->fcm_token = $request->token;
        $user->save();
        return response()->json(['Token successfully stored.']);
    }

}
