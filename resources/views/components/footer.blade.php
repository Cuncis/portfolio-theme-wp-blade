{{-- components/footer.blade.php --}}

<footer class="border-t border-slate-800 bg-slate-950 mt-24">
  <div class="max-w-6xl mx-auto px-6 py-10 flex flex-col md:flex-row items-center justify-between gap-4">

    <p class="text-slate-500 text-sm">
      &copy; {{ date('Y') }} {{ \get_bloginfo('name') }}. {{ __('All rights reserved.', 'sage') }}
    </p>

    <nav aria-label="{{ __('Footer navigation', 'sage') }}">
      {!! \wp_nav_menu([
        'theme_location' => 'footer_navigation',
        'menu'           => 'Footer Menu',
        'container'      => false,
        'menu_class'     => 'flex items-center gap-5 [&_a]:text-slate-500 [&_a]:text-sm [&_a]:hover:text-white [&_a]:transition-colors',
        'echo'           => false,
        'fallback_cb'    => false,
      ]) !!}
    </nav>

  </div>
</footer>
