{{-- components/nav.blade.php --}}
@props(['menu' => []])

<header class="site-header">
  <div class="site-header__inner">
    <a class="site-header__logo" href="{{ \home_url('/') }}">
      {{ \get_bloginfo('name') }}
    </a>

    <button
      class="site-header__toggle"
      aria-controls="primary-nav"
      aria-expanded="false"
      aria-label="{{ __('Toggle navigation', 'sage') }}"
    >
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav id="primary-nav" class="site-header__nav" aria-label="{{ __('Primary navigation', 'sage') }}">
      {!! \wp_nav_menu([
        'theme_location' => 'primary_navigation',
        'container'      => false,
        'menu_class'     => 'nav__menu',
        'echo'           => false,
        'fallback_cb'    => false,
      ]) !!}
    </nav>
  </div>
</header>
