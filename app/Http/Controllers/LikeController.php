<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Like;


class LikeController extends Controller
{
    public function like($postId)
    {
    	$post = Post::findOrFail($postId);
    	$user = Auth::user();
    	$likeId = $user->getPostLikeId($post);
    	
    	if (!$likeId) {
    		$like = $post->likes()->make();
    		$like->timestamps = false;
    		$like->user()->associate($user);
    		$like->save();
    	} else {
    		$like = Like::find($likeId);
    		$like->delete();
    	}

    	return redirect()
    		->route('posts.show', $post);
    }
}
