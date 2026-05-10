{{-- single-portfolio.blade.php --}}
@extends('layouts.app')

@section('content')
  <article class="max-w-4xl mx-auto px-6 py-16">

    <header class="mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-8">{{ $title }}</h1>

      @if($client || $year || $services)
        <dl class="flex flex-wrap gap-6 mb-8 border-t border-b border-slate-800 py-6">
          @if($client)
            <div>
              <dt class="text-xs uppercase tracking-widest text-slate-500 mb-1">Client</dt>
              <dd class="text-white font-medium">{{ $client }}</dd>
            </div>
          @endif
          @if($year)
            <div>
              <dt class="text-xs uppercase tracking-widest text-slate-500 mb-1">Year</dt>
              <dd class="text-white font-medium">{{ $year }}</dd>
            </div>
          @endif
          @if($services)
            <div>
              <dt class="text-xs uppercase tracking-widest text-slate-500 mb-1">Services</dt>
              <dd class="text-white font-medium">{{ $services }}</dd>
            </div>
          @endif
        </dl>
      @endif

      @if($url)
        <x-button href="{{ $url }}" variant="primary">
          Visit Project &rarr;
        </x-button>
      @endif
    </header>

    <div class="prose prose-invert prose-lg max-w-none">
      {!! $content !!}
    </div>

    @if($gallery)
      <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach($gallery as $image)
          <figure class="overflow-hidden rounded-lg">
            <img
              src="{{ $image['url'] }}"
              alt="{{ $image['alt'] }}"
              class="w-full h-full object-cover"
              loading="lazy"
            >
            @if($image['caption'])
              <figcaption class="text-sm text-slate-500 mt-2 px-1">{{ $image['caption'] }}</figcaption>
            @endif
          </figure>
        @endforeach
      </div>
    @endif

  </article>
@endsection