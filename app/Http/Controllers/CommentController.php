<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreComment;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreComment $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreComment $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        Comment::create($data);

        return response()->json(Post::where('id', $data['post_id'])
            ->with(['comments' => function ($query) {
                return $query->orderByDesc('created_at');
            }, 'user', 'comments.user'])
            ->get(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $a = $comment->delete();
        return response()->json($a, 200);
    }
}
