<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $category->name }} - Simple Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="{{ url('/') }}" class="btn btn-secondary mb-3">Back to Home</a>

    <h2>Category: {{ $category->name }}</h2>
    <p>{{ $category->description ?? '' }}</p>

    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <small class="text-muted">{{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}</small>
                        <p class="card-text mt-2">{{ Str::limit($post->content, 100) }}</p>
                        <a href="{{ url('/blog/'.$post->slug) }}" class="btn btn-sm btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No posts in this category yet.</p>
        @endforelse
    </div>
</div>
</body>
</html>
