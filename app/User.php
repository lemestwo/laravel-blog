<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'created_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAuthor(): bool
    {
        return $this->is_author;
    }

    public function hasFacebook(): bool
    {
        return $this->facebook_link != null;
    }

    public function hasTwitter(): bool
    {
        return $this->twitter_link != null;
    }

    public function hasGithub(): bool
    {
        return $this->github_link != null;
    }

    public function hasYoutube(): bool
    {
        return $this->youtube_link != null;
    }

    public function hasInstagram(): bool
    {
        return $this->instagram_link != null;
    }
}
