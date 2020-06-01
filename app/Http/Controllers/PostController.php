<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
            $featured = Post::where('is_featured', true)->first();
            $posts = Post::latest('published_at')->where('is_featured', false)->paginate(10);
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
     * @param StorePost $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePost $request)
    {
        $request->validated();

        if ($request->input('featured') != null) {
            $this->resetFeatured(0);
            $isFeatured = true;
        } else {
            $isFeatured = false;
        }

        Post::create([
            'slug' => Str::of($request->input('title'))->slug(),
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'content' => $request->input('content'),
            'published_at' => $request->input('published_at') == null ? Carbon::now() : Carbon::createFromFormat('d/m/Y H:i', $request->input('publish')),
            'user_id' => Auth::id(),
            'is_featured' => $isFeatured
        ]);
        return redirect()->route('user.posts');
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
     * @param StorePost $request
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StorePost $request, Post $post)
    {
        if ($post->user_id == Auth::id()) {
            $request->validated();

            $post->slug = Str::of($request->input('title'))->slug();
            $post->title = $request->input('title');
            $post->summary = $request->input('summary');
            $post->content = $request->input('content');
            $post->published_at = $request->input('published_at') == null ? Carbon::now() : Carbon::createFromFormat('d/m/Y H:i', $request->input('publish'));

            if ($request->input('featured') != null) {
                $this->resetFeatured($post->id);
                $post->is_featured = true;
            } else {
                $post->is_featured = false;
            }

            $post->save();

            return redirect()->route('user.posts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            $post->delete();
            return redirect()->route('user.posts');
        }
    }

    public function resetFeatured($id)
    {
        Post::where([['is_featured', true], ['id', '!=', $id]])->update(['is_featured' => false]);
    }
}
