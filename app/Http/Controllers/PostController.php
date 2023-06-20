<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|unique:posts,slug',
            'title' => 'required',
            'thumbnail' => 'nullable',
            'excerpt' => 'required',
            'body' => 'required',
            'published_at' => 'nullable|date',
        ]);
        return $validatedData;
        $post = Post::create($validatedData);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return response()->json($post);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'exists:users,id',
            'category_id' => 'exists:categories,id',
            'slug' => 'unique:posts,slug,' . $id,
            'title' => 'required',
            'thumbnail' => 'nullable',
            'excerpt' => 'required',
            'body' => 'required',
            'published_at' => 'nullable|date',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validatedData);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(null, 204);
    }
}
