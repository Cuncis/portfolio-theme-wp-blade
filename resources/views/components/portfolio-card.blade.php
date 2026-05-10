{{-- components/portfolio-card.blade.php --}}
@props(['item'])

<article class="group relative overflow-hidden rounded-xl bg-slate-900 border border-slate-800 hover:border-slate-600 transition-colors">
  @if(\has_post_thumbnail($item->ID))
    <div class="aspect-[4/3] overflow-hidden">
      <img
        src="{{ \get_the_post_thumbnail_url($item->ID, 'large') }}"
        alt="{{ \get_the_title($item->ID) }}"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
        loading="lazy"
      >
    </div>
  @endif

  <div class="p-6 flex flex-col gap-2">
    <h2 class="text-lg font-semibold text-white">
      {{ \get_the_title($item->ID) }}
    </h2>

    @if(\function_exists('get_field') && $client = \get_field('client_name', $item->ID))
      <span class="text-sm text-slate-400">{{ $client }}</span>
    @endif

    <div class="pt-1">
      <x-button href="{{ \get_permalink($item->ID) }}" variant="ghost">
        View Project &rarr;
      </x-button>
    </div>
  </div>

  <a
    href="{{ \get_permalink($item->ID) }}"
    class="absolute inset-0"
    aria-label="View {{ \get_the_title($item->ID) }}"
    tabindex="-1"
  ></a>
</article>