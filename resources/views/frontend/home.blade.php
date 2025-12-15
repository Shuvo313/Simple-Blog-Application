<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Simple Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Simple Blog</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @if(session('user_id'))
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <!-- Hero Section -->
    <div class="jumbotron p-5 bg-light rounded mb-5 text-center">
        <h1>Welcome to My Simple Blog</h1>
        <p>Read articles by category</p>
        <a href="#recent-posts" class="btn btn-primary">View Recent Posts</a>
    </div>

    <!-- Categories -->
    <h3>Categories</h3>
    <div class="mb-4">
        @foreach($categories as $category)
            <a href="{{ url('/category/'.$category->slug) }}" class="btn btn-outline-primary mb-2">{{ $category->name }}</a>
        @endforeach
    </div>

    <!-- Recent Posts -->
    <h3 id="recent-posts">Recent Posts</h3>
    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <small class="text-muted">{{ $post->category->name }} | {{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}</small>
                        <p class="card-text mt-2">{{ Str::limit($post->content, 100) }}</p>
                        <a href="{{ url('/blog/'.$post->slug) }}" class="btn btn-sm btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No posts available.</p>
        @endforelse
    </div>
</div>
</body>
</html>
