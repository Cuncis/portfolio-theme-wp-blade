{{-- components/post-card.blade.php --}}
@props(['post'])

<article class="group flex flex-col bg-slate-900 rounded-xl overflow-hidden border border-slate-800 hover:border-slate-600 transition-colors">
  @if(\has_post_thumbnail($post->ID))
    <a href="{{ \get_permalink($post->ID) }}" class="block overflow-hidden aspect-video">
      <img
        src="{{ \get_the_post_thumbnail_url($post->ID, 'medium') }}"
        alt="{{ \get_the_title($post->ID) }}"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
        loading="lazy"
      >
    </a>
  @endif

  <div class="flex flex-col flex-1 p-6 gap-3">
    <span class="text-xs text-slate-500 font-medium uppercase tracking-wider">
      {{ \get_the_date('M j, Y', $post->ID) }}
    </span>

    <h2 class="text-lg font-semibold text-white leading-snug">
      <a href="{{ \get_permalink($post->ID) }}" class="hover:text-indigo-400 transition-colors">
        {{ \get_the_title($post->ID) }}
      </a>
    </h2>

    <p class="text-slate-400 text-sm leading-relaxed line-clamp-3 flex-1">
      {{ \get_the_excerpt($post->ID) }}
    </p>

    <div class="pt-2">
      <x-button href="{{ \get_permalink($post->ID) }}" variant="ghost">
        Read More &rarr;
      </x-button>
    </div>
  </div>
</article>