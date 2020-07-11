<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    // post comments
    public function index($postId)
    {
        $comments = $this->commentRepository->postComment($postId);
        return response()->json([
            'success' => true,
            'message' => 'Fetched comments',
            'data'    => $comments
        ]);
    }

    // save comment to db
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'comment' =>'required',
            'post_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ]);
        }

        $data['user_id'] = Auth::id();
        $comment = $this->commentRepository->store($data);
        return response()->json([
            'success' => true,
            'message' => 'Commented successfully',
            'data'    => $comment
        ]);
    }

    // update comment
    public function update(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'comment' =>'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ]);
        }

        $comment = $this->commentRepository->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Comment updated successfully',
            'data'    => $comment
        ]);
    }

    // delete comment
    public function destroy($id)
    {
        $comment = $this->commentRepository->destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully',
            'data'    => $comment
        ]);
    }
}
