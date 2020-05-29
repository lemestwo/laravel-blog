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
     * @return View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $tag = $request->get('tag');
        $isSearchOrTag = false;
        if ($search != null || $tag != null) {
            $featured = null;
            if($search != null) {
                $posts = Post::where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('summary', 'LIKE', '%' . $search . '%')
                    ->orWhere('content', 'LIKE', '%' . $search . '%')
                    ->paginate(10);
                $posts->appends(['search' => $search]);
            } else {
                $posts = Post::whereHas('tags', function($query) use ($tag) {
                    $query->whereName($tag);
                })->paginate(10);
                $posts->appends(['tag' => $tag]);
            }
            $isSearchOrTag = true;
        } else {
            $featured = Post::where('status', 2)->with('tags')->first();
            $posts = Post::latest('published_at')->paginate(10);
        }
        return view('posts.index', ['posts' => $posts, 'featured' => $featured, 'isSearchOrTag' => $isSearchOrTag]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param string $slug
     * @return View
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        dd($post->tags);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
