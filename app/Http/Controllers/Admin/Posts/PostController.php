<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Traits\PostIndexSortableColumns;
use App\Models\Post;
use App\Services\UploadStorageService;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    use PostIndexSortableColumns;

    protected $uploadStorage;

    public function __construct(UploadStorageService $uploadStorage)
    {
        $this->uploadStorage = $uploadStorage->inDirectory('images/posts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('see-post'), Response::HTTP_FORBIDDEN);

        $builder = Post::with('user')->withoutTrashed();
        $posts = $this->fetchPosts($builder);

        return view('posts.index', ['posts' => $posts]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $this->storeFeaturedImage($validated);
        Auth::user()->posts()->create($validated);
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
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $this->storeFeaturedImage($validated);
        $post->update($validated);
        return back();
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
            return back();
        }
        $post->delete();
        return back();
    }

    private function storeFeaturedImage(array &$validated)
    {
        if (! isset($validated['featured_image'])) {
            return;
        }
        $validated['featured_image'] = $this->uploadStorage->store($validated['featured_image'])->save();
    }
}
