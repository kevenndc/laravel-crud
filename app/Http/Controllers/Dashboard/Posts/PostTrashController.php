<?php

namespace App\Http\Controllers\Dashboard\Posts;

use App\Http\Controllers\Controller;
use App\Http\Traits\PostIndexSortableColumns;
use App\Models\Post;

class PostTrashController extends Controller
{
    use PostIndexSortableColumns;

    public function index()
    {
        $builder = Post::with('user')->onlyTrashed();
        $posts = $this->fetchPosts($builder);
        return view('posts.index')->with('posts', $posts);
    }
}
