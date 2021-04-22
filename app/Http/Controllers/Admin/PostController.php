<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = \request()->query();
        if (empty($query)) {
            $posts = Post::all();
        } else {
            $posts = $this->getPostsWithQuery($query);
        }
        extract(Post::getCounts());
        return view('posts.index', compact(['posts', 'postCount', 'publishedCount', 'draftCount', 'trashedCount']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('admin.posts');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashIndex()
    {
        $posts = Post::onlyTrashed()->get();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Get posts with query strings.
     * @param array $query
     * @return Post[]
     */
    private function getPostsWithQuery(array $query)
    {
        if (isset($query['trashed'])) {
            return Post::onlyTrashed()->get();
        }

        if (isset($query['published'])) {
            return Post::where('published', $query['published'])->get();
        }

        return [];
    }
}
