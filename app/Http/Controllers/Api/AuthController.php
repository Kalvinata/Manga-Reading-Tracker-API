<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $params = $request->all();

            $validator = Validator::make($params, [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ], 400);
            }

            $user = User::where('email', $params['email'])->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Account not found'
                ], 404);
            }

            if (!Hash::check($params['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password does not match'
                ], 401);
            }

            $token = JWTAuth::fromUser($user);

            $currentDateTime = Carbon::now();
            $expirationDateTime = $currentDateTime
                ->addSeconds(JWTAuth::factory()->getTTL() * 60);

            $info = [
                'type' => 'Bearer',
                'token' => $token,
                'expires' => $expirationDateTime->format('Y-m-d H:i:s')
            ];

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => $info
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function refresh()
    {
        $currentDateTime = Carbon::now();
        $expirationDateTime = $currentDateTime
            ->addSeconds(JWTAuth::factory()->getTTL() * 60);

        $info = [
            'type' => 'Bearer',
            'token' => JWTAuth::refresh(),
            'expires' => $expirationDateTime->format('Y-m-d H:i:s')
        ];

        return response()->json([
            'success' => true,
            'message' => 'Successfully refreshed',
            'data' => $info
        ], 200);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ], 200);
    }
}