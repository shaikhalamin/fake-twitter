<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\Follow\FollowService;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $followService;

    public function __construct(FollowService $followService)
    {
        $this->followService = $followService;
    }

    public function list($userId)
    {
        $followingIds = $this->followService->getFollowingByFollowerId($userId);
        return User::whereNotIn('_id', [...$followingIds, $userId])->orderBy('updated_at', 'desc')->paginate(50);
    }

    public function create(array $data)
    {
        $payload = [
            ...$data,
            'password' => Hash::make($data['password']),
            'avatar' => 'https://res.cloudinary.com/deundpsr2/image/upload/v1700135801/general/user/ameotogmx5u2fjhnv73r.jpg',
            'location' => 'Dhaka, Bangladesh',
            'bio' => 'A human being'
        ];
        return User::create($payload);
    }

    public function show(string $id, array $relations = [])
    {
        $user = User::with($relations)->find($id);

        return $user;
    }

    // public function update(array $data, string $id)
    // {
    //     $user = $this->show($id);
    //     $user->update($data);

    //     return $user->refresh();
    // }

    public function update(array $data, $user)
    {
        $user->update($data);

        return $user->refresh();
    }

    public function delete(string $id): bool
    {
        return $this->show($id)->delete();
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function findByUserName(string $username, array $relations = [])
    {
        //'tweets', 'followers.following', 'following.follower', 'likes'
        return User::with($relations)->where('username', $username)->first();
    }

    public function updateRefreshToken($id, $token)
    {
        $user = $this->show($id);
        $user->update(['refresh_token' => $token]);
        return $user;
    }

    public function findByRefreshToken($token)
    {
        $user =  User::where('refresh_token', $token)->first();
        return $user;
    }
}
