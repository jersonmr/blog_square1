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
        $allowedSorts = ['newest', 'oldest'];
        $sort = request('publication_date');
        $direction = $sort == 'newest' ? 'desc' : 'asc';

        if(!is_null($sort) && ! collect($allowedSorts)->contains($sort)) {
            abort(400, __('Invalid Query Parameter'));
        }

        $posts = Post::query()
            ->select('title', 'description', 'publication_date')
            ->where('user_id', '=', auth()->id())
            ->orderBy('publication_date', $direction)
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
