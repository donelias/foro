<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function create()
    {
        return view('posts.create');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        //$post = Post::create($request->all());
        $post = new  Post($request->all());

        //asignacion del usuario al post
        auth()->user()->posts()->save($post);

        return "Post: ".$post->title;
    }
}
