<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Traits\PostIndexSortableColumns;
use App\Models\Post;

class PublishedPostController extends Controller
{
    use PostIndexSortableColumns;

    public function index()
    {
        $builder = Post::with('user')->where('published', true);
        $posts = $this->fetchPosts($builder);

        return view('posts.index', ['posts' => $posts, 'counts' => Post::countAllStates()]);
    }
}
