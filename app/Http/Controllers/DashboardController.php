<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->select('title', 'description', 'publication_date')
            ->where('user_id', '=', auth()->id())
            ->latest('publication_date')
            ->paginate();

        return view('dashboard', compact('posts'));
    }
}
