<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::where('title', 'like', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
         Post::create([
            'title' =>  $request->title,
            'body' =>  $request->body,
            'user_id' => auth()->id(),
        ]);

        return redirect('/posts')->with('success', 'A post was created successfully.');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, $id)
    {

        $post = Post::find($id);
        $post->update($request->only(['title', 'body']));
        return redirect('/posts')->with('success', 'A post was updated successfully.');
    }

    public function show($id)
    {
        $post = Post::select(['posts.*', 'users.name as author'])
        ->join('users', 'users.id', 'posts.user_id')
        ->where('posts.id', $id)
        ->first();
        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('/posts')->with('success', 'A post was deleted successfully.');
    }

}