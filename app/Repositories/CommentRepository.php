<?php


namespace App\Repositories;

use App\Interfaces\CommentInterface;
use App\Models\PostComment;
use Auth;

class CommentRepository implements CommentInterface
{
    public function postComment($postId)
    {
        return PostComment::where('post_id', $postId)->get();
    }

    public function store($data)
    {
        $comment = PostComment::create($data);
        return $comment->setAttribute('user', Auth::user());
    }

    public function update($data)
    {
        return PostComment::where('id', $data['id'])->update($data);
    }

    public function destroy($id)
    {
        return PostComment::find($id)->delete();
    }
}
