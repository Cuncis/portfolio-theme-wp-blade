{{-- front-page.blade.php --}}
@extends('layouts.app')

@section('content')

  {{-- Hero --}}
  @if($hero)
    <section class="min-h-[85vh] flex flex-col items-center justify-center text-center px-6 py-24">
      <h1 class="text-5xl md:text-7xl font-bold text-white tracking-tight leading-tight max-w-3xl">
        {{ $hero['heading'] }}
      </h1>
      <p class="mt-6 text-lg md:text-xl text-slate-400 max-w-xl">
        {{ $hero['subheading'] }}
      </p>
      <div class="mt-10">
        <x-button href="{{ $hero['cta_url'] }}" variant="primary">
          {{ $hero['cta_label'] }}
        </x-button>
      </div>
    </section>
  @else
    <section class="min-h-[85vh] flex flex-col items-center justify-center text-center px-6 py-24">
      <h1 class="text-5xl md:text-7xl font-bold text-white tracking-tight leading-tight max-w-3xl">
        Hi, I'm {{ \get_bloginfo('name') }}
      </h1>
      <p class="mt-6 text-lg text-slate-400 max-w-xl">
        {{ \get_bloginfo('description') }}
      </p>
    </section>
  @endif

  {{-- Services --}}
  @if($services)
    <section class="max-w-6xl mx-auto px-6 py-20">
      <h2 class="text-3xl font-bold text-white text-center mb-12">What I Do</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($services as $service)
          <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 hover:border-indigo-800 transition-colors">
            <h3 class="text-lg font-semibold text-white mb-2">{{ $service['title'] }}</h3>
            <p class="text-slate-400 text-sm leading-relaxed">{{ $service['description'] }}</p>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- Recent Work --}}
  @if($recentWork)
    <section class="max-w-6xl mx-auto px-6 py-20">
      <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl font-bold text-white">Recent Work</h2>
        <x-button href="/portfolio" variant="secondary">View All &rarr;</x-button>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($recentWork as $item)
          <x-portfolio-card :item="$item" />
        @endforeach
      </div>
    </section>
  @endif

  {{-- Recent Posts --}}
  @if($recentPosts)
    <section class="max-w-6xl mx-auto px-6 py-20">
      <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl font-bold text-white">From the Blog</h2>
        <x-button href="/blog" variant="secondary">Read the Blog &rarr;</x-button>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($recentPosts as $post)
          <x-post-card :post="$post" />
        @endforeach
      </div>
    </section>
  @endif

@endsection