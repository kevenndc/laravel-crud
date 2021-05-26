<?php

namespace App\Http\Controllers\Dashboard\Posts;

use App\Http\Controllers\Controller;
use App\Http\Traits\PostIndexSortableColumns;
use App\Models\Post;
use App\Services\MessageNotificationService;

class TrashedPostController extends Controller
{
    use PostIndexSortableColumns;

    private $messages;

    public function __construct(MessageNotificationService $messages)
    {
        $this->messages = $messages;
    }

    public function index()
    {
        $builder = Post::with('user')->onlyTrashed();
        $posts = $this->fetchPosts($builder);
        return view('posts.index')->with('posts', $posts);
    }

    public function update(Post $post)
    {
        $post->restore();
        $this->messages->showSuccess('The post was successfully restored.');
        return redirect()->route('posts.trash.index');
    }

    /**
     * Delete the specified post from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->forceDelete();
        $this->messages->showSuccess('The post was deleted.');
        return redirect()->route('posts.trash.index');
    }
}
