<?php


namespace App\Repositories;

use App\Interfaces\PostInterface;
use App\Models\Post;

class PostRepository implements PostInterface
{
    public function all()
    {
        return Post::orderBy('id', 'desc')
            ->with(['category', 'user', 'comments', 'likes'])
            ->get();
    }

    public function view($id)
    {
        return Post::with(['category', 'user', 'comments', 'likes'])
            ->where('id', $id)
            ->first();
    }

    public function store($data)
    {
        return Post::create($data);
    }

    public function update($data)
    {
        return Post::where('id', $data['id'])->update($data);
    }

    public function destroy($id)
    {
        return Post::find($id)->delete();
    }
}
