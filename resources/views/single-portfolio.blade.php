{{-- single-portfolio.blade.php --}}
@extends('layouts.app')

@section('content')
  <article class="single-portfolio">

    <header class="single-portfolio__header">
      <h1>{{ $title }}</h1>

      <dl class="project-meta">
        @if($client)
          <dt>Client</dt>
          <dd>{{ $client }}</dd>
        @endif

        @if($year)
          <dt>Year</dt>
          <dd>{{ $year }}</dd>
        @endif

        @if($services)
          <dt>Services</dt>
          <dd>{{ $services }}</dd>
        @endif
      </dl>

      @if($url)
        <x-button href="{{ $url }}" variant="primary">
          Visit Project
        </x-button>
      @endif
    </header>

    <div class="single-portfolio__content">
      {!! $content !!}
    </div>

    @if($gallery)
      <div class="single-portfolio__gallery">
        @foreach($gallery as $image)
          <figure>
            <img
              src="{{ $image['url'] }}"
              alt="{{ $image['alt'] }}"
              loading="lazy"
            >
            @if($image['caption'])
              <figcaption>{{ $image['caption'] }}</figcaption>
            @endif
          </figure>
        @endforeach
      </div>
    @endif

  </article>
@endsection