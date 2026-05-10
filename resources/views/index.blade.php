{{-- index.blade.php --}}
@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto px-6 py-16">
    <header class="mb-12">
      <h1 class="text-4xl font-bold text-white">{{ $archiveTitle ?? 'Blog' }}</h1>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @forelse($posts as $post)
        <x-post-card :post="$post" />
      @empty
        <p class="text-slate-400 col-span-3">No posts found.</p>
      @endforelse
    </div>

    <div class="mt-12">
      @include('partials.pagination')
    </div>
  </div>
@endsection