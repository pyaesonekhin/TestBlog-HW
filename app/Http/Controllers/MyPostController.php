<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MyPostController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->latestPosts();
        return view('my_posts.index', compact('posts'));
    }

}