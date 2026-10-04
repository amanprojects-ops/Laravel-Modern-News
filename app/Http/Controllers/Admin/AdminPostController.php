<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadHelper;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AdminPostController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = DB::table('posts')
            ->leftJoin('users', 'posts.created_by', '=', 'users.id')
            ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'users.name as writer_name', 'users.id as writer_id', 'categories.name as category_name')
            ->orderBy('posts.updated_at', 'desc')
            ->get();

        return view('admin.posts.view', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create')->with('title', 'Create Post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->withErrors(['csrf' => 'Invalid request try again.']);
        }
        $request->validate([
            'post_title'        => 'required|string|max:60',
            'short_description' => 'required|string|max:160',
            'post_keywords'     => 'required|string|max:255',
            'content'           => 'required|string',
            'category'          => 'required|exists:categories,id',
            'featureImage'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $post = new Post();
        $post->title             = $request->input('post_title');
        $post->short_description = $request->input('short_description');
        $post->post_keywords     = $request->input('post_keywords');
        $post->description       = $request->input('content');
        $post->category_id       = $request->input('category');

        if ($request->hasFile('featureImage')) {
            $post->image = UploadHelper::upload($request->file('featureImage'), 'post_images');
        }

        $post->created_by = auth()->id() ?? 1;
        $post->status     = $request->input('status', 0);
        $post->save();

        return redirect()->route('admin.posts.view', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.update', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->withErrors(['csrf' => 'Invalid request try again.']);
        }
        $request->validate([
            'title'             => 'required|string|max:60',
            'short_description' => 'required|string|max:160',
            'keywords'          => 'required|string|max:255',
            'content'           => 'required|string',
            'category'          => 'required|exists:categories,id',
            'feature_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        try {
            $post = Post::findOrFail($id);
            $post->title             = $request->input('title');
            $post->short_description = $request->input('short_description');
            $post->post_keywords     = $request->input('keywords');
            $post->description       = $request->input('content');
            $post->category_id       = $request->input('category');

            if ($request->hasFile('feature_image')) {
                // Delete old image and upload new one
                $post->image = UploadHelper::upload(
                    $request->file('feature_image'),
                    'post_images',
                    $post->image  // old path for deletion
                );
            }

            $post->status     = $request->input('status', 0);
            $post->created_by = auth()->id() ?? 1;
            $post->updated_at = now();
            $post->save();

            return redirect()->back()->with('success', 'Post updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating post: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        UploadHelper::delete($post->image);
        $post->delete();
        return redirect()->route('admin.posts.view')->with('success', 'Post deleted successfully.');
    }

    /**
     * Update the status of the post.
     */
    public function updateStatus(Request $request, string $id)
    {
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->withErrors(['csrf' => 'Invalid request try again.']);
        }
        $post = Post::findOrFail($id);
        $post->status = $request->input('status');
        $post->save();
        return redirect()->back()->with('success', 'Post updated successfully.');
    }

    /**
     * View a single post.
     */
    public function view(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.view-single-post', compact('post'));
    }

    /**
     * Show the temp post preview.
     */
    public function tempPost(string $id)
    {
        $post = Post::with('category:id,name', 'user:id,name,image,last_login')->findOrFail($id);
        return view('admin.posts.temp-post', compact('post'));
    }
}
