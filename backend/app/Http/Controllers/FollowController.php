<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\UpdateFollowRequest;
use App\Models\Follow;
use App\Services\Follow\FollowService;
use Symfony\Component\HttpFoundation\Response as RESPONSE;

class FollowController extends AbstractApiController
{
    private $followService;

    public function __construct(FollowService $followService)
    {
        $this->followService = $followService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Follow::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFollowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFollowRequest $request)
    {
        $followerId = $request->user()->_id;
        $followeeId = $request->validated()['followee_id'];

        $response = [
            'success' => true,
            'data' => $this->followService->followUnfollow($followerId, $followeeId)
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_OK);
    }

    public function followingFollowerList()
    {
        $followerId = auth()->user()->_id;
        $response = [
            'success' => true,
            'data' => [
                'following' => $this->followService->getFollowingByFollowerId($followerId),
                'follower' => $this->followService->getFollowerByFollowerId($followerId)
            ]
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_OK);
    }
}
