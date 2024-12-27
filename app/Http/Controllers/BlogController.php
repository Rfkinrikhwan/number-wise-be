<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);

        return response()->json([
            'blog' => $blogs->map(function ($blog) {
                return [
                    'slug' => $blog->slug,
                    'image' => $blog->image,
                    'title' => $blog->title,
                    'description' => $blog->description
                ];
            })
        ]);
    }

    public function show(Blog $blog)
    {
        return response()->json([
            'slug' => $blog->slug,
            'image' => $blog->image,
            'title' => $blog->title,
            'content' => $blog->content
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'content' => $request->content,
            'image' => $imageName,
        ]);

        return response()->json([
            'message' => 'Blog created successfully',
            'blog' => $blog
        ], 201);
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'content' => 'string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['title', 'description', 'content']);

        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path('images/' . $blog->image))) {
                unlink(public_path('images/' . $blog->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        if ($request->has('title')) {
            $data['slug'] = Str::slug($request->title);
        }

        $blog->update($data);

        return response()->json([
            'message' => 'Blog updated successfully',
            'blog' => $blog
        ]);
    }

    public function destroy(Blog $blog)
    {
        if (file_exists(public_path('images/' . $blog->image))) {
            unlink(public_path('images/' . $blog->image));
        }

        $blog->delete();

        return response()->json([
            'message' => 'Blog deleted successfully'
        ]);
    }
}
