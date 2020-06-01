<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'summary',
        'content',
        'is_featured',
        'published_at',
        'user_id'
    ];

    public function getCommentsCount()
    {
        return $this->comment_count;
    }

    public function getPublishedAtFormatted()
    {
        return date('M d, Y', strtotime($this->published_at));
    }

    public function getPublishedAtEdit()
    {
        return date('d/m/Y H:i', strtotime($this->published_at));
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
