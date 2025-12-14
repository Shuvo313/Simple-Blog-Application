<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class FrontendController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $recentPosts = Post::with('category','user')->where('status','published')->latest('published_at')->take(6)->get();
        return view('frontend.home', compact('categories','recentPosts'));
    }

    public function index()
    {
        $posts = Post::with('category','user')->where('status','published')->latest('published_at')->paginate(10);
        return view('frontend.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with('category','user')->where('status','published')->where('slug',$slug)->firstOrFail();
        $more = Post::where('category_id',$post->category_id)->where('id','!=',$post->id)->where('status','published')->latest('published_at')->take(5)->get();
        return view('frontend.show', compact('post','more'));
    }

    public function category($slug)
    {
        $category = Category::where('name', $slug)->orWhere('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('status','published')->latest('published_at')->paginate(10);
        return view('frontend.category', compact('category','posts'));
    }
}
