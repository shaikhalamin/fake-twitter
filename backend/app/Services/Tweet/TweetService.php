<?php

namespace App\Services\Tweet;

use App\Models\Tweet;
use App\Services\Follow\FollowService;

class TweetService
{
    private $followService;

    public function __construct(FollowService $followService)
    {
        $this->followService = $followService;
    }

    public function list($userId)
    {
        $followingIds = $this->followService->getFollowingByFollowerId($userId);
        return Tweet::with(['user', 'likes.user'])->whereIn('user_id', [...$followingIds, $userId])->orderBy('created_at', 'desc')->paginate(25);
    }

    public function create($user, $data)
    {
        $tweet =  Tweet::create([...$data, 'user_id' => $user->_id]);
        $user->tweets()->saveMany([$tweet]);
        return $tweet;
    }
}
