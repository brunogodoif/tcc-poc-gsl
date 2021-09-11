<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/auth",
     * summary="Faz a autenticação no sistema",
     * description="Autenticação na plataforma com base no e-mail e senha de um usuário, token JWT será retornado em caso de usuário autenticado. Este token deverá ser enviado em todas as requisições dos demais serviços.",
     * operationId="authLogin-1",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="E-mail e senha de usuário",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345")
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Ok, usuário autenticado",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Ok"),
     *       @OA\Property(property="token_access", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc..."),
     *       @OA\Property(property="token_type", type="string", example="jwt"),
     *       @OA\Property(property="token_expires_in", type="int", example="3600")
     *        )
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Usuário não autorizado, e-mail ou senha inválido",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Login Fail, pls check password")
     *        )
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     * path="/auth",
     * summary="Valida a autenticação",
     * description="Faz a validação do token JWT informado, validando se o token é válido e se o usuário esta autorizado a acessar os serviços da plataforma",
     * operationId="authLogin-2",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Token JWT recebido da requisição POST /auth",
     *    @OA\JsonContent(
     *       required={"token","password"},
     *       @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2N..."),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Ok, Token validado e usuário autenticado",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Ok"),
     *        )
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Token informado não esta autorizado a utilizar o serviço",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not authorized")
     *        )
     *     ),
     * @OA\Response(
     *    response=404,
     *    description="Token informado esta inválido",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Token invalid")
     *        )
     *     )
     * )
     */
    public function authValidate(Request $request)
    {

        $AuthService = new AuthService;
        $tokenDataValidate = $AuthService->validateJWT($request->get('token'));

        if (is_object($tokenDataValidate)) {
            return $tokenDataValidate;
        }

        return $AuthService->authenticateUserActive($tokenDataValidate['id'], $tokenDataValidate['email']);
    }
}
