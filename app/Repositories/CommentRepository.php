<?php


namespace App\Repositories;

use App\Interfaces\CommentInterface;
use App\Models\PostComment;

class CommentRepository implements CommentInterface
{
    public function postComment($postId)
    {
        return PostComment::where('post_id', $postId)->get();
    }

    public function store($data)
    {
        return PostComment::create($data);
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
