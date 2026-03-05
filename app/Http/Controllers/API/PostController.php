<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController
{
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    public function post(string $id)
    {
        return response()->json(Post::findOrFail($id));
    }

    public function posts()
    {
        return response()->json(Post::all());
    }
}
