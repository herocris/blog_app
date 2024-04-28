<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostsController extends Controller
{
    public function show($id)
    {
        $post=Post::find($id);
        $categories=Category::all();
        return view('posts.show',compact('post','categories'));
    }
}
