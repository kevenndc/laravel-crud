<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Traits\PostIndexSortableColumns;
use App\Models\Post;

class PostTrashController extends Controller
{
    use PostIndexSortableColumns;

    public function index()
    {
        $posts = Post::with('user')->onlyTrashed();
        $posts = $this->fetchPosts($posts);

        return view('posts.index')->with('posts', $posts);
    }
}
