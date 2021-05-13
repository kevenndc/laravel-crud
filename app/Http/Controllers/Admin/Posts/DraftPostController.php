<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Traits\PostIndexSortableColumns;
use App\Models\Post;

class DraftPostController extends Controller
{
    use PostIndexSortableColumns;

    public function index()
    {
        $builder = Post::with('user')->where('status', 'draft');
        $posts = $this->fetchPosts($builder);

        return view('posts.index')->with('posts', $posts);
    }
}
