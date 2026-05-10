{{-- components/button.blade.php --}}
@props([
    'variant' => 'primary',
    'href'    => null,
])

@php
$base = 'inline-flex items-center justify-center px-5 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500';

$variants = [
    'primary'   => 'bg-indigo-600 text-white hover:bg-indigo-500 active:bg-indigo-700',
    'secondary' => 'border border-slate-600 text-slate-300 hover:border-indigo-500 hover:text-white',
    'ghost'     => 'text-indigo-400 hover:text-indigo-300',
];

$classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
  </a>
@else
  <button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
  </button>
@endif