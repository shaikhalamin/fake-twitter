<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as RESPONSE;

class AuthController extends AbstractApiController
{
    private $userService;
    private $authService;

    public function __construct(UserService $userService, AuthService $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
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

        $loginResult = $this->authService->createUserToken($user);

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

    /**
     * Refresh the access & refresh token with old refresh token
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh(Request $request)
    {
        $refreshToken =  $request->header('RefreshToken');

        $userToken = $this->authService->reGenerateUserToken($refreshToken);

        if (is_null($userToken)) {
            $errorResponse = [
                'status' => false,
                'message' => 'Token not found',
            ];

            return $this->apiErrorResponse($errorResponse, RESPONSE::HTTP_UNAUTHORIZED);
        }

        return $userToken;
    }



    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        $response = [
            'success' => true,
            'data' => $request->user(),
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_OK);
    }
}
