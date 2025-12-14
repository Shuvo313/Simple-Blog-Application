<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category','user')->latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string|min:50',
            'status' => 'required|in:draft,published',
        ]);

        $validated['user_id'] = $request->user()->id;
        if($validated['status'] === 'published'){
            $validated['published_at'] = now();
        }

        Post::create($validated);
        return redirect()->route('admin.posts.index')->with('success','Post created.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string|min:50',
            'status' => 'required|in:draft,published',
        ]);

        if($validated['status'] === 'published' && !$post->published_at){
            $validated['published_at'] = now();
        }
        if($validated['status'] === 'draft'){
            $validated['published_at'] = null;
        }

        $post->update($validated);
        return redirect()->route('admin.posts.index')->with('success','Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success','Post deleted.');
    }
}
