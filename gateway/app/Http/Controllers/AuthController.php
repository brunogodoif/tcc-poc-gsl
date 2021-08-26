<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function authLogin(Request $request)
    {
        $credentials['email'] = $request->get('email');
        $credentials['password'] = $request->get('password');

        if (!isset($credentials['email']) or $credentials['email'] == '' or !isset($credentials['password']) or $credentials['password'] == '') {
            return response()->json(['message' => 'Login Fail, please check email and password'], 400);
        }

        $AuthService = new AuthService;
        return $AuthService->authenticate($credentials);
    }

    public function authValidate(Request $request)
    {
        if (!isset($request['token'])) {
            throw new \Exception('INVALID_TOKEN', 500);
        }

        $tokenRequest = JWTAuth::getToken(($request['token']) ?? null);

        $AuthService = new AuthService;

        $tokenDataValidate = $AuthService->validateJWT($tokenRequest);

        if (is_object($tokenDataValidate)) {
            return $tokenDataValidate;
        }

        return $AuthService->authenticateUserActive($tokenDataValidate['id'], $tokenDataValidate['email']);
    }

    public function teste(Request $request)
    {
        $response = Http::post('nginx-service-servicos-cliente/api', [
            'name' => 'Steve',
            'role' => 'Network Administrator',

        ]);

        return $response;
    }

    public function teste2(Request $request)
    {
        $response = Http::post('nginx-service-gestao-estrategia/api', [
            'name' => 'Bruno',
            'role' => 'Network Administrator',

        ]);
        return  $response;
    }
}
