<?php

namespace App\Services\Like;

use App\Models\Like;

class LikeService
{
    public function like($data = [])
    {
        $liked = $this->alreadyLiked($data);
        if (!is_null($liked)) {
            return $liked;
        }
        $like = Like::create($data);
        return $like;
    }

    public function alreadyLiked($data)
    {
        return Like::where($data)->first();
    }
}
