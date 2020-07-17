<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    private $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    // all posts
    public function index()
    {
        if(request()->get('queryParams')) {
            $posts = $this->postRepository->searchPost(request()->get('queryParams'));
        } else {
            $posts = $this->postRepository->all();
        }
        return response()->json([
            'success' => true,
            'message' => 'Posts fetched successfully',
            'data'    => $posts
        ]);
    }

    // single post
    public function view($id)
    {
        $post = $this->postRepository->view($id);
        return response()->json([
            'success' => $post ? true : false,
            'message' => 'Post fetched successfully',
            'data'    => $post
        ]);
    }

    // save post to db
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'title' =>'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ]);
        }

        $data['user_id'] = Auth::id();
        $post = $this->postRepository->store($data);
        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data'    => $post
        ]);
    }

    // update post value in db
    public function update(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'title' =>'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ]);
        }

        $post = $this->postRepository->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data'    => $post
        ]);
    }

    // delete post from db
    public function destroy($id)
    {
        $post = $this->postRepository->destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
            'data'    => $post
        ]);
    }
}
