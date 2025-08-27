<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        if (!$googleUser) {
            return errorJson('Google gmail tasdiqlanmadi');
        }
        Log::info('google_user', [$googleUser]);
        $string = \Illuminate\Support\Str::uuid();
        try {
            if ($googleUser) {
                $user = User::updateOrCreate([
                    'email' => $googleUser->getEmail()
                ],[
                    'username' => $googleUser->getName(),
                    'password' => bcrypt($googleUser->getEmail().$string),
                ]);
                $token = $user->createToken('user_token')->plainTextToken;
            }
        }catch (\Exception $exception) {
            Log::info($exception->getMessage());
        }
        return response()->json(['success' => true, 'access_token' => $token, 'message' => 'ok']);
    }
}
