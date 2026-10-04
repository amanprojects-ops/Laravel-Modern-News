<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Setting;
use App\Models\Categorie;
use App\Models\User;
use App\Models\Filelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $categoriesCount = Categorie::count();
        $usersCount = User::count();
        $filesCount = Filelist::count();

        $recentPosts = DB::table('posts')
            ->leftJoin('users', 'posts.created_by', '=', 'users.id')
            ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'users.name as writer_name', 'categories.name as category_name')
            ->orderBy('posts.updated_at', 'desc')
            ->limit(8)
            ->get();

        $topCategories = Categorie::leftJoin('posts', 'categories.id', '=', 'posts.category_id')
            ->select('categories.id', 'categories.name', DB::raw('count(posts.id) as total_posts'))
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_posts')
            ->limit(5)
            ->get();

        $recentUsers = User::leftJoin('roles', 'users.role', '=', 'roles.id')
            ->select('users.*', 'roles.role as role_name')
            ->orderBy('users.created_at', 'desc')
            ->limit(5)
            ->get();

        // Monthly trend data for the last 6 active periods
        $rawMonthly = DB::table('posts')
            ->select(DB::raw("SUBSTRING(created_at, 1, 7) as ym"), DB::raw('count(*) as count'))
            ->whereNotNull('created_at')
            ->groupBy('ym')
            ->orderBy('ym', 'desc')
            ->limit(6)
            ->get()
            ->reverse()
            ->values();

        $monthLabels = [];
        $monthCounts = [];
        foreach ($rawMonthly as $item) {
            if (!empty($item->ym)) {
                $timestamp = strtotime($item->ym . '-01');
                $monthLabels[] = $timestamp ? date('M Y', $timestamp) : $item->ym;
                $monthCounts[] = (int) $item->count;
            }
        }

        // Top authors
        $topAuthors = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.created_by')
            ->select('users.id', 'users.name', 'users.email', DB::raw('count(posts.id) as posts_count'))
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'posts',
            'drafts',
            'active',
            'rejected',
            'categoriesCount',
            'usersCount',
            'filesCount',
            'recentPosts',
            'topCategories',
            'recentUsers',
            'monthLabels',
            'monthCounts',
            'topAuthors'
        ));
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
