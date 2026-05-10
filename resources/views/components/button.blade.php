{{-- components/button.blade.php --}}
@props([
    'variant' => 'primary',
    'href'    => null,
])

@if($href)
  
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "btn btn--{$variant}"]) }}
  >
    {{ $slot }}
  </a>
@else
  <button
    {{ $attributes->merge(['class' => "btn btn--{$variant}"]) }}
  >
    {{ $slot }}
  </button>
@endif