<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
           'name' => 'required|string',
           'email' => 'required|string'
        ],[
            'name' => 'Name maydonini to\'ldirish majburiy',
            'email' => 'Email maydonini to\'ldirish majburiy'
        ]);
        if ($validation->fails()){
            return response()->json([
                'message' => $validation->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $params = $request->all();
        $user = User::where('email', $params['email'])->first();
        if ($user) {
            return \response()->json(['success' => true, 'message' => 'Bunday foydalanuvchi mavjud']);
        }

        $data = User::create([
            'username' => $params['name'],
            'email' => $params['email'],
            'password' => bcrypt($params['email'].Str::uuid())
        ]);

        $token = $data->createToken('user_token')->plainTextToken;
        return \response()->json(['success' => true, 'access_token' => $token, 'message' => 'Tabriklaymiz muvaffaqiyatli o\'ttingiz']);
    }
}
