<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Services\UploadStorageService;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
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
        $filter = $request->get('filter');
        $column = $request->get('orderby') ?? 'created_at';
        $order = $request->get('order') ?? 'desc';

        $posts = $this->filterPosts($filter)
                    ->orderBy($column, $order)
                    ->paginate(10);

        return view('posts.index', [
            'posts' => $posts->withQueryString(),
            'counts' => Post::getCounts()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create-post');
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
        $post = Auth::user()->posts()->create($validated);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit-post')->with('post', $post);
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
        } else {
            $post->delete();
        }
        return back();
    }

    /**
     * Return a list of posts filtered by a giver filter (switch key).
     *
     * @param array $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function filterPosts($filter)
    {
        switch ($filter) {
            case 'trashed':
                return Post::onlyTrashed();
            case 'published':
                return Post::where('published', true);
            case 'drafts':
                return Post::where('published', false);
            default:
                return Post::withoutTrashed();
        }
    }

    private function storeFeaturedImage(array &$validated)
    {
        if (! isset($validated['featured_image'])) {
            return;
        }
        $validated['featured_image'] = $this->uploadStorage->store($validated['featured_image'])->save();
    }
}
