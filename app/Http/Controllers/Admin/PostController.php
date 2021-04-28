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
        $column = $request->get('orderby') ?? 'created_at';
        $order = $request->get('order') !== 'asc';

        if (empty($posts = $this->getFilteredPosts($filter))) {
            $posts = Post::paginate(10);
        }

        return view('posts.index', [
            'posts' => $posts->sortBy($column, SORT_REGULAR, $order),
            'counts' => Post::getCounts()
        ]);
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
                return Post::onlyTrashed()->paginate(10);
            case 'published':
                return Post::where('published', true)->paginate(10);
            case 'drafts':
                return Post::where('published', false)->paginate(10);
            default:
                return [];
        }
    }
}
