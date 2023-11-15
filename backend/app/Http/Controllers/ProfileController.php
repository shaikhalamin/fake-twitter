<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as RESPONSE;

class ProfileController extends AbstractApiController
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:sanctum');
        $this->userService = $userService;
    }

    /**
     * Find by username
     *
     * @return \Illuminate\Http\Response
     */
    public function findByUserName($username)
    {
        $response = [
            'success' => true,
            'data' => $this->userService->findByUserName($username, ['tweets', 'followers.following', 'following.follower', 'likes']),
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_OK);
    }
}
