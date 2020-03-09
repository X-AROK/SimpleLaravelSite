<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Post;

class PostController extends Controller
{
	private $validForm = [
    		'title' => 'required',
    		'body' => 'required|min:30'
    	];

	public function index(Request $request)
	{
		$q = $request->input('q') ?? '';
		$posts = Post::where('title', 'like', "%{$q}%")
			->orderBy('updated_at', 'desc')
			->paginate(10);
		

		return view('posts.index', compact('posts', 'q'));
	}

	public function show($id)
	{
		$post = Post::findOrFail($id);
		return view('posts.show', compact('post'));
	}

    public function create()
    {
    	$post = new Post();
    	return view('posts.create', compact('post'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, $this->validForm);

    	$post = new Post();
    	$post->fill($request->all());
    	$post->creator()->associate(Auth::user());
    	$post->save();

    	return redirect()
    		->route('posts.index');
    }

    public function edit($id)
    {
    	$post = Post::findOrFail($id);
    	if (Gate::denies('update-post', $post)) {
    		return redirect()
    			->route('posts.show', $post);
    	}

    	return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, $this->validForm);

    	$post = Post::findOrFail($id);
    	if (Gate::denies('update-post', $post)) {
    		return redirect()
    			->route('posts.index');
    	}

    	$post->fill($request->all());
    	$post->save();

    	return redirect()
    		->route('posts.show', $post);
    }

    public function destroy($id)
    {
    	$post = Post::find($id);
    	if ($post && Gate::allows('update-post', $post)) {
    		$likes = $post->likes;
    		foreach ($likes as $like) {
    			$like->delete();
    		}
    		$post->delete();
    	}

    	return redirect()
    		->route('posts.index');
    }
}
