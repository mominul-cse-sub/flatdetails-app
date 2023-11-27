<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\FileTrait;

class FlatController extends Controller
{
    use FileTrait;

    function index(Request $request)
    {
        $user= User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

             $token = $user->createToken('my-app-token')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

             return response($response, 201);
    }

    public function notification ($id=null)
    {
        $notification = Notification::where('id', $id)->first();

        $notification->is_read = 1;
        $notification->read_at = date('Y-m-d H:i:s');

        $notification->save();

        return $notification;
    }

    public function uploadAvatar(Request $request)
    {
        $file = $request->file('file');

        $upload = $this->uploadFile($file,'flat-', Auth::user());

        Auth::user()->avatar = $upload->id;
        Auth::user()->save();

        return $upload;
    }




}
