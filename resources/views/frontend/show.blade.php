@extends('layout')
@section('content')
  <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Home</a>

  <h1>{{ $post->title }}</h1>
  <p>By {{ $post->user->name }} | <a href="{{ route('categories.show', $post->category->name) }}">{{ $post->category->name }}</a> | {{ $post->published_at?->format('M d, Y') }}</p>
  <div>{!! $post->content !!}</div>

  <hr>
  <h5>More posts from this category</h5>
  <ul>
    @forelse($more as $m)
      <li><a href="{{ route('blogs.show', $m->slug) }}">{{ $m->title }}</a></li>
    @empty
      <li>No more posts</li>
    @endforelse
  </ul>
@endsection
