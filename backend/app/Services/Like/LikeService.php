<?php

namespace App\Services\Like;

use App\Models\Like;

class LikeService
{
    public function likeUnlike($data = [])
    {
        $liked = $this->alreadyLiked($data);
        if (!is_null($liked)) {
            return $liked->delete();
        }
        $like = Like::create($data);
        return $like;
    }

    public function alreadyLiked($data)
    {
        return Like::where($data)->first();
    }
}
