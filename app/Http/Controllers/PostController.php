<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->with(['user','likes'])->paginate(20);
        return view('posts.index',[
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        //validate the post
        $this->validate($request,[
            'body' => 'required'
        ]);
        //store the post
        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();

    }
    //delete the post
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return back();
    }
}
