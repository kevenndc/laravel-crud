<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $column = $request->get('orderby') ?? 'created_at';
        $order = $request->get('order') ?? 'desc';

        try {
            $users = $this->filterUsers($request->get('filter'))
                        ->orderBy($column, $order)
                        ->paginate(10)
                        ->withQueryString();
        } catch (\Exception $exception) {
            $users = null;
        }

        return view('users.index', [
            'users' => $users
//            'counts' => User::countRoles()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        $validated = $request->validated();
        dd($validated);
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return true;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return true;
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
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return true;
    }

    /**
     * Return a list of posts filtered by a giver filter (switch key).
     *
     * @param array $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function filterUsers($filter)
    {
        switch ($filter) {
            case 'admins':
                return User::onlyTrashed();
            case 'editors':
                return User::where('published', true);
            case 'collaborators':
                return User::where('published', false);
            default:
                return User::query();
        }
    }
}
