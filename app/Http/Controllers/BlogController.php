<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController
{
    // View a single blog post by slug
    public function getBlog($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail(); // returns 404 if not found

        return view('frontend.view-post', compact('post'));
    }

    // View posts under a specific category
    public function getCategory($categorySlug)
    {
        // Convert slug to category name format
        $categoryName = str_replace('-', ' ', $categorySlug);

        $posts = Post::leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->where('categories.name', 'like', '%' . $categoryName . '%')
            ->where('posts.status', 1) // optional: only published posts
            ->select('posts.title', 'posts.slug', 'posts.updated_at')
            ->orderBy('posts.updated_at', 'desc')
            ->paginate(10);

        return view('frontend.category', [
            'posts' => $posts,
            'category' => $categoryName
        ]);
    }

    //View Single Tag Content
    public function GetTag($tag)
    {
        $tag = str_replace('-', ' ', $tag);
        return $tag;
    }

    //Search Content
    public function Search($query)
    {
        $query = str_replace('-', ' ', $query);
        return $query;
    }
}
