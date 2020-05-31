<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $isSearch = false;

        if ($search != null) {
            $featured = null;
            $posts = Post::where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('summary', 'LIKE', '%' . $search . '%')
                ->orWhere('content', 'LIKE', '%' . $search . '%')
                ->paginate(10)
                ->appends(['search' => $search]);
            $isSearch = true;
        } else {
            $featured = Post::where('status', 2)->first();
            $posts = Post::latest('published_at')->paginate(10);
        }

        $topPosts = Post::orderByDesc('comment_count')->get()->take(5);

        return view('posts.index', [
            'posts' => $posts,
            'featured' => $featured,
            'isSearch' => $isSearch,
            'topPosts' => $topPosts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource using it's slug.
     *
     * @param $slug
     * @return View
     */
    public function show($slug)
    {
        return view('posts.show', [
            'post' => Post::where('slug', $slug)
                ->with(['comments' => function ($query) {
                    return $query->orderByDesc('created_at');
                }, 'user', 'comments.user'])
                ->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post)
    {
        return view('posts.createEdit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
