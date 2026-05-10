{{-- components/post-card.blade.php --}}
@props(['post'])

<article class="post-card">
  @if(has_post_thumbnail($post->ID))
    <img
      src="{{ get_the_post_thumbnail_url($post->ID, 'medium') }}"
      alt="{{ get_the_title($post->ID) }}"
      class="post-card__image"
      loading="lazy"
    >
  @endif

  <div class="post-card__body">
    <span class="post-card__date">
      {{ get_the_date('M j, Y', $post->ID) }}
    </span>

    <h2 class="post-card__title">
      <a href="{{ get_permalink($post->ID) }}">
        {{ get_the_title($post->ID) }}
      </a>
    </h2>

    <p class="post-card__excerpt">
      {{ get_the_excerpt($post->ID) }}
    </p>
  </div>

  <footer class="post-card__footer">
    <x-button href="{{ get_permalink($post->ID) }}" variant="ghost">
      Read More
    </x-button>
  </footer>
</article>