<?php

namespace App\Http\Controllers\API;

use App\Common\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return ResponseFormatter::success($posts, 'Posts data retrieved successfully');
    }

    public function show(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            return ResponseFormatter::success($post, 'Post data retrieved successfully');
        } else {
            return ResponseFormatter::error(404, 'Post not found');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, array_values($validator->errors()->toArray())[0][0]);
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => str()->slug($request->title),
            'status' => $request->status,
        ]);

        return ResponseFormatter::success($post, 'Post created successfully');
    }

    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return ResponseFormatter::error(404, 'Post not found');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, array_values($validator->errors()->toArray())[0][0]);
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => str()->slug($request->title),
            'status' => $request->status,
        ]);

        return ResponseFormatter::success($post, 'Post updated successfully');
    }

    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return ResponseFormatter::error(404, 'Post not found');
        }

        $post->delete();
        return ResponseFormatter::success(null, 'Post deleted successfully');
    }
}
