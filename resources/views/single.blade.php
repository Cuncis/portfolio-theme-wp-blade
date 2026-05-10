{{-- single.blade.php --}}
@extends('layouts.app')

@section('content')
  <article class="single-post">
    <header class="single-post__header">
      <h1>{{ $title }}</h1>
      <p class="single-post__meta">
        {{ $date }} · {{ $author }}
      </p>

      @foreach($categories as $cat)
        <a href="{{ get_category_link($cat->term_id) }}" class="badge">
          {{ $cat->name }}
        </a>
      @endforeach
    </header>

    <div class="single-post__content">
      {!! $content !!}
    </div>
  </article>

  @if($related)
    <section class="related-posts">
      <h2>You Might Also Like</h2>
      <div class="posts-grid">
        @foreach($related as $post)
          <x-post-card :post="$post" />
        @endforeach
      </div>
    </section>
  @endif
@endsection