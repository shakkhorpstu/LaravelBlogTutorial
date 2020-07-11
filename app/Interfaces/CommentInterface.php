<?php


namespace App\Interfaces;

interface CommentInterface
{
    public function postComment($postId);

    public function store($data);

    public function update($data);

    public function destroy($id);
}
