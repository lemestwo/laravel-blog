<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->orderByDesc('published_at')->get();
        $comments = Comment::where('user_id', $user->id)->with('post')->orderByDesc('created_at')->get();
        return view('user.show', [
            'userData' => $user,
            'countData' => [$posts->count(), $comments->count(), 0],
            'recentPosts' => $posts->take(5),
            'recentComments' => $comments->take(5)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->description = $request->input('description');
        $user->save();
        return redirect()->route('user.show');
    }

    public function showPosts()
    {
        return view('user.posts', ['posts' => Post::where('user_id', Auth::id())->get()]);
    }
}
