<?php

namespace App\Http\Controllers\Dashboard\Posts;

use App\Http\Traits\PostIndexSortableColumns;
use App\Models\Post;
use App\Services\MessageNotificationService;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class PostController extends Controller
{
    use PostIndexSortableColumns;

    protected $messages;

    public function __construct(MessageNotificationService $messages)
    {
        $this->messages = $messages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $builder = Post::with('user')->withoutTrashed();
        $posts = $this->fetchPosts($builder);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        Auth::user()->posts()->create($validated);
        $this->messages->showSuccess('The post was successfully created!');
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return View
     */
    public function update(PostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);
        $this->messages->showSuccess('The post was successfully updated!');
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Move the specified post to trash.
     *
     * @param  Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $this->messages->showSuccess('The post was moved to trash.');
        return redirect()->back();
    }
}
