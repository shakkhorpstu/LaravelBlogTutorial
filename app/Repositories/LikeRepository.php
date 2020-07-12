<?php


namespace App\Repositories;


use App\Interfaces\LikeInterface;
use App\Models\PostLike;
use Auth;


class LikeRepository implements LikeInterface
{
    public function index($postId)
    {
        return PostLike::where('post_id', $postId)->get();
    }

    public function store($data)
    {
        $data['user_id'] = Auth::id();
        $postLike = PostLike::where('post_id', $data['post_id'])
            ->where('user_id', $data['user_id'])
            ->first();

        if($postLike) {
            $postLike->delete();
        } else {
            $postLike = PostLike::create($data);
        }

        return $postLike;
    }
}
