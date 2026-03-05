<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::count();
        $drafts = Post::where('status', 0)->count();
        $active = Post::where('status', 1)->count();
        $rejected = Post::where('status', 2)->count();
        $recentPosts = Post::orderBy('updated_at', 'desc')
            ->leftJoin('users', 'posts.created_by', '=', 'users.id')
            ->select('posts.*', 'users.name as writer_name', 'users.id as writer_id')
            ->limit(10)
            ->get();
        return view('admin.dashboard', compact('posts', 'drafts', 'active', 'rejected', 'recentPosts'));
    }

    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {

        return view('admin.dashboard', [
            'title' => 'Admin Dashboard',
            'active' => 'dashboard',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /**
         * Undocumented function
         *
         * @param string $id
         * @return void
         */
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function profile(string $id)
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
}
