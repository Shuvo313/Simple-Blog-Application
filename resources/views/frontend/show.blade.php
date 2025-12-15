<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }} - Simple Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="{{ url('/') }}" class="btn btn-secondary mb-3">Back to Home</a>

    <h2>{{ $post->title }}</h2>
    <p>
        <strong>Category:</strong> 
        <a href="{{ url('/category/'.$post->category->slug) }}">{{ $post->category->name }}</a> |
        <strong>Author:</strong> {{ $post->user->name }} |
        <strong>Published:</strong> {{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}
    </p>

    <div class="mt-4">
        {!! nl2br(e($post->content)) !!}
    </div>

    <!-- More posts from this category -->
    <h4 class="mt-5">More posts from {{ $post->category->name }}</h4>
    <ul>
        @foreach($post->category->posts()->where('id','!=',$post->id)->where('status','published')->take(5)->get() as $p)
            <li><a href="{{ url('/blog/'.$p->slug) }}">{{ $p->title }}</a></li>
        @endforeach
    </ul>
</div>
</body>
</html>
