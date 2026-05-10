{{-- index.blade.php --}}
@extends('layouts.app')

@section('content')
  <header class="archive-header">
    <h1>{{ $archiveTitle ?? 'Blog' }}</h1>
  </header>

  <div class="posts-grid">
    @forelse($posts as $post)
      <x-post-card :post="$post" />
    @empty
      <p>No posts found.</p>
    @endforelse
  </div>

  @include('partials.pagination')
@endsection