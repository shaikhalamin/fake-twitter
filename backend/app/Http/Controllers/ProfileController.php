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
            'data' => $this->userService->findByUserName($username, ['followers.following', 'following.follower', 'tweets' => function ($query) {
                return $query->orderBy('created_at', 'desc');
            }, 'tweets.user', 'likes']),
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_OK);
    }
}
