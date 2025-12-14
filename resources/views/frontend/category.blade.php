@extends('layout')
@section('content')
  <h1>{{ $category->name }}</h1>
  <p>{{ $category->description }}</p>

  @if($posts->count())
    @foreach($posts as $post)
      <div class="card mb-3">
        <div class="card-body">
          <h4>{{ $post->title }}</h4>
          <p>{{ Str::limit(strip_tags($post->content),150) }}</p>
          <a href="{{ route('blogs.show', $post->slug) }}" class="btn btn-primary btn-sm">Read More</a>
        </div>
      </div>
    @endforeach

    {{ $posts->links() }}
  @else
    <p>No posts in this category yet.</p>
  @endif
@endsection
