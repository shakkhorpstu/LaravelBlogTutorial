<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\LikeRepository;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    private $likeRepository;
    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function index($postId)
    {
        $postLikes = $this->likeRepository->index($postId);
        return response()->json([
            'success' => true,
            'message' => 'Fetched post likes',
            'data'    => $postLikes
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'post_id' =>'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ]);
        }

        $postLike = $this->likeRepository->store($data);
        return response()->json([
            'success' => true,
            'message' => 'Successfull',
            'data'    => $postLike
        ]);
    }
}
