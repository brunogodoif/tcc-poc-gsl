<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Users;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTFactory;

class AuthService
{

    public function authenticate($credentials)
    {

        $user  = Users::select('id', 'name', 'email', 'password', 'profile_id')->whereEmail($credentials['email'])->whereStatus(true)->first();
        if (!$user) {
            return response()->json(['message' => 'Login Fail, please check email'], 401);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Login Fail, pls check password'], 401);
        }

        unset($user->password);

        $token = $this->generateTokenJwt($user);
        return response()->json([
            'message' => 'Ok',
            'token_access' => $token,
            'token_type' => 'jwt',
            'token_expires_in' => auth('api')->factory()->getTTL() * 60
        ], 200);
    }

    public function generateTokenJwt($userData)
    {
        $userData->exp = Carbon::now()->addSeconds(3600)->timestamp;
        JWTAuth::getJWTProvider()->setSecret(env('JWT_SECRET'));
        JWTFactory::customClaims($userData->getAttributes());
        $payload = JWTFactory::make($userData->getAttributes());
        $token = JWTAuth::encode($payload);
        return $token->get();
    }

    public function authenticateUserActive($id, $email)
    {
        $user  = Users::select('id', 'name', 'email', 'password', 'profile_id')->whereId($id)->whereEmail($email)->whereStatus(true)->first();
        if (!$user) {
            return response()->json(['message' => 'Not authorized'], 401);
        }
        return response()->json(['message' => 'Ok'], 200);
    }


    public function validateJWT($token)
    {
        $token = str_ireplace('Bearer ', '', $token);
        try {
            $token = JWTAuth::setToken(($token) ?? null);
            //JWTAuth::getJWTProvider()->setSecret($this->secret_cortex);
            $apy = JWTAuth::getPayload($token)->toArray();
            return $apy;
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['message' => 'Token Expired'], 404);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'Token Invalid'], 404);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => 'Token Absent'], 404);
        }
    }
}
