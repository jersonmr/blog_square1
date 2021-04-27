<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->select('title', 'description', 'publication_date')
            ->where('user_id', '=', auth()->id())
            ->applySort(request('publication_date'))
            ->paginate();

        return view('dashboard', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);

        auth()->user()->posts()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'publication_date' => now(),
        ]);

        return redirect()->route('dashboard')
            ->with(['message' => __('Post created')]);
    }
}
