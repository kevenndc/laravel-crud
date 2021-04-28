<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Ramsey\Collection\Collection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter');
        if (empty($posts = $this->getFilteredPosts($filter))) {
            $posts = Post::all();
        }
        $posts = $this->getOrderedPosts($posts);
        return view('posts.index', ['posts' => $posts, 'counts' => Post::getCounts()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $post = Auth::user()->posts()->create($validated);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        dd($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        dd($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->trashed()) {
            $post->forceDelete();
        } else {
            $post->delete();
        }
        return back();
    }

    /**
     * Get posts with query strings.
     * @param array $query
     * @return Post[]
     */
    private function getFilteredPosts($filter)
    {
        switch ($filter) {
            case 'trashed':
                return Post::onlyTrashed()->get();
            case 'published':
                return Post::where('published', true)->get();
            case 'drafts':
                return Post::where('published', false)->get();
            default:
                return [];
        }
    }

    private function getOrderedPosts(\Illuminate\Support\Collection $posts)
    {
        $column = \request()->get('orderby');
        if (! isset($column)) {
            return $posts->sortByDesc('created_at');
        }
        if (\request()->get('order') === 'desc') {
            return $posts->sortByDesc($column);
        }
        return $posts->sortBy($column);
    }
}
