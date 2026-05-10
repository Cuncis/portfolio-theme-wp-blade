{{-- components/portfolio-card.blade.php --}}
@props(['item'])

<article class="portfolio-card">
  @if(\has_post_thumbnail($item->ID))
    <div class="portfolio-card__image">
      <img
        src="{{ \get_the_post_thumbnail_url($item->ID, 'large') }}"
        alt="{{ \get_the_title($item->ID) }}"
        loading="lazy"
      >
    </div>
  @endif

  <div class="portfolio-card__body">
    <h2 class="portfolio-card__title">
      {{ \get_the_title($item->ID) }}
    </h2>

    @if(\function_exists('get_field') && $client = \get_field('client_name', $item->ID))
      <span class="portfolio-card__client">{{ $client }}</span>
    @endif
  </div>

  <a
    href="{{ \get_permalink($item->ID) }}"
    class="portfolio-card__link"
    aria-label="View {{ \get_the_title($item->ID) }}"
  ></a>
</article>