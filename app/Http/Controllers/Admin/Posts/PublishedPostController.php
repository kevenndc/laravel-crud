<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Traits\PostSortableColumns;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PublishedPostController extends Controller
{
    use PostSortableColumns;

    public function index()
    {
        abort_if(Gate::denies('see-post'), Response::HTTP_FORBIDDEN);

        $posts = Post::with('user')->where('published', 1);

        if (Gate::denies('see-others-posts')) {
            $posts = $posts->where('user_id', Auth::user()->id);
        }

        $posts = $this->sortColumns($posts);

        //dd($posts->paginate(10));

        $posts = $posts->paginate(10)->withQueryStrings();

        return view('posts.index', ['posts' => $posts, 'counts' => Post::countAllStates()]);
    }
}
