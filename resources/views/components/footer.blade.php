{{-- components/footer.blade.php --}}

<footer class="site-footer">
  <div class="site-footer__inner">
    <p class="site-footer__copy">
      &copy; {{ date('Y') }} {{ \get_bloginfo('name') }}. {{ __('All rights reserved.', 'sage') }}
    </p>

    <nav class="site-footer__nav" aria-label="{{ __('Footer navigation', 'sage') }}">
      {!! \wp_nav_menu([
        'theme_location' => 'footer_navigation',
        'container'      => false,
        'menu_class'     => 'footer-nav__menu',
        'echo'           => false,
        'fallback_cb'    => false,
      ]) !!}
    </nav>
  </div>
</footer>
