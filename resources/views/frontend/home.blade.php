@extends('layout')
@section('content')
  <div class="jumbotron p-5 rounded bg-light">
    <h1>Welcome to My Simple Blog</h1>
    <p class="lead">Read articles by category</p>
    <a href="{{ route('blogs.index') }}" class="btn btn-primary">View All Posts</a>
  </div>

  <h3 class="mt-4">Categories</h3>
  <div class="row">
    @foreach($categories as $cat)
      <div class="col-md-3 mb-3">
        <a href="{{ route('categories.show', $cat->name) }}" class="text-decoration-none">
          <div class="card h-100">
            @if($cat->image)
              <img src="{{ asset('storage/'.$cat->image) }}" class="card-img-top" />
            @endif
            <div class="card-body">
              <h5 class="card-title">{{ $cat->name }}</h5>
              <p class="card-text">{{ Str::limit($cat->description,60) }}</p>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  <h3 class="mt-4">Recent Posts</h3>
  <div class="list-group">
    @foreach($recentPosts as $post)
      <a href="{{ route('blogs.show', $post->slug) }}" class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">{{ $post->title }}</h5>
          <small>{{ $post->published_at?->format('M d, Y') }}</small>
        </div>
        <p class="mb-1">{{ Str::limit(strip_tags($post->content), 150) }}</p>
        <small>Category: {{ $post->category->name }}</small>
      </a>
    @endforeach
  </div>
@endsection
