<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        $posts = Post::orderByDesc('published_at')->get();
        $comments = Comment::with('post')->orderByDesc('created_at')->get();
        $users = User::orderByDesc('created_at')->get();
        return view('admin.home', [
            'totalPosts' => $posts->count(),
            'totalComments' => $comments->count(),
            'totalUsers' => $users->count(),
            'lastPosts' => $posts->take(5),
            'lastComments' => $comments->take(5),
            'lastUsers' => $users->take(5)
        ]);
    }

    public function posts()
    {
        return view('admin.posts', ['posts' => Post::orderByDesc('published_at')->paginate(20)]);
    }

    public function postsDestroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts');
    }

    public function comments()
    {
        return view('admin.comments', ['comments' => Comment::orderByDesc('created_at')->paginate(20)]);
    }

    public function commentsDestroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments');
    }

    public function users(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $users = User::where('name', 'LIKE', '%' . $search . '%')->with(['posts', 'comments'])->paginate(10)->appends(['search' => $search]);
        } else {
            $users = User::with('posts', 'comments')->paginate(10);
        }
        return view('admin.users', ['users' => $users]);
    }

    public function userDestroy(User $user)
    {
        if ($user->level < 2) {
            $user->delete();
        }
        return redirect()->route('admin.users');
    }

    public function userUpdate(Request $request, User $user)
    {
        $level = $request->input('level') == null ? 0 : $request->input('level');

        $request->validate([
            'level' => 'min:0|max:2'
        ]);
        $user->level = $level;
        $user->save();
        return redirect()->route('admin.users');
    }
}
