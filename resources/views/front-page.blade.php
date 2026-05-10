{{-- front-page.blade.php --}}
@extends('layouts.app')

@section('content')

  {{-- Hero --}}
  @if($hero)
    <section class="hero">
      <h1 class="hero__title">{{ $hero['heading'] }}</h1>
      <p class="hero__sub">{{ $hero['subheading'] }}</p>
      <x-button href="{{ $hero['cta_url'] }}">
        {{ $hero['cta_label'] }}
      </x-button>
    </section>
  @endif

  {{-- Services --}}
  @if($services)
    <section class="services">
      <h2>What I Do</h2>
      <div class="services__grid">
        @foreach($services as $service)
          <div class="service-item">
            <h3>{{ $service['title'] }}</h3>
            <p>{{ $service['description'] }}</p>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- Recent Work --}}
  @if($recentWork)
    <section class="recent-work">
      <h2>Recent Work</h2>
      <div class="work-grid">
        @foreach($recentWork as $item)
          <x-portfolio-card :item="$item" />
        @endforeach
      </div>
      <x-button href="/portfolio" variant="secondary">
        View All Work
      </x-button>
    </section>
  @endif

  {{-- Recent Posts --}}
  @if($recentPosts)
    <section class="recent-posts">
      <h2>From the Blog</h2>
      <div class="posts-grid">
        @foreach($recentPosts as $post)
          <x-post-card :post="$post" />
        @endforeach
      </div>
      <x-button href="/blog" variant="secondary">
        Read the Blog
      </x-button>
    </section>
  @endif

@endsection