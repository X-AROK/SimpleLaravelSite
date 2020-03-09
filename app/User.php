<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    public function posts()
    {
        return $this->hasMany( __NAMESPACE__ . '\Post', 'creator_id');
    }

    public function likes()
    {
        return $this->hasMany( __NAMESPACE__ . '\Like');
    }

    public function getPostLikeId(Post $post)
    {
        $like = Like::where('user_id', $this->id)
            ->where('post_id', $post->id)
            ->first();

        if ($like){
            return $like->id;
        }

        return false;
    }
}
