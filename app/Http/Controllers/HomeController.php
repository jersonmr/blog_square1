<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->select('title', 'description', 'publication_date')
            ->latest('publication_date')
            ->paginate();

        return view('home', compact('posts'));
    }
}
