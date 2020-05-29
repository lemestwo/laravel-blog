<?php

namespace App\Observers;

use App\Comment;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param \App\Comment $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $comment->post->comment_count++;
        $comment->post->save();
    }

    /**
     * Handle the comment "updated" event.
     *
     * @param \App\Comment $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "deleted" event.
     *
     * @param \App\Comment $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        $comment->post->comment_count--;
        $comment->post->save();
    }

    /**
     * Handle the comment "restored" event.
     *
     * @param \App\Comment $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "force deleted" event.
     *
     * @param \App\Comment $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}
