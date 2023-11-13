<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as RESPONSE;

class AuthController extends AbstractApiController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Login method.
     *
     * @param  \App\Http\Requests\AuthRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(AuthRequest $request)
    {
        $payload = $request->validated();

        $user = $this->userService->findByEmail($payload['email']);

        if (!$user || !Hash::check($payload['password'], $user->password)) {
            $errorResponse = [
                'status' => false,
                'message' => 'Email or Password did not match !',
            ];

            return $this->apiErrorResponse($errorResponse, RESPONSE::HTTP_UNAUTHORIZED);
        }

        $accessTokenTime = Carbon::now()->addDays(5);
        $refreshTokenTime = Carbon::now()->addDays(30);

        $loginResult = [
            'status' => true,
            'access_token' => $user->createToken($user->email, ['expiresAt'=> $accessTokenTime])->plainTextToken,
            'refresh_token' => $user->createToken($user->email, ['expiresAt'=> $refreshTokenTime])->plainTextToken,
            'access_token_expires_at' => $accessTokenTime->getTimestamp(),
            'user' => $user,
        ];

        return $this->apiSuccessResponse($loginResult, RESPONSE::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $response = [
            'success' => true,
            'data' => null,
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_NO_CONTENT);
    }
    
}
