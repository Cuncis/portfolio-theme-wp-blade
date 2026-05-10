{{-- components/nav.blade.php --}}
@props(['menu' => []])

<header class="sticky top-0 z-50 bg-slate-950/90 backdrop-blur border-b border-slate-800">
  <div class="max-w-6xl mx-auto px-6 flex items-center justify-between h-16">

    <a href="{{ \home_url('/') }}" class="text-white font-bold text-lg tracking-tight hover:text-indigo-400 transition-colors">
      {{ \get_bloginfo('name') }}
    </a>

    <button
      id="nav-toggle"
      class="md:hidden flex flex-col gap-1.5 p-2 text-slate-400 hover:text-white transition-colors"
      aria-controls="primary-nav"
      aria-expanded="false"
      aria-label="{{ __('Toggle navigation', 'sage') }}"
    >
      <span class="block w-5 h-0.5 bg-current"></span>
      <span class="block w-5 h-0.5 bg-current"></span>
      <span class="block w-5 h-0.5 bg-current"></span>
    </button>

    <nav id="primary-nav" class="hidden md:flex items-center gap-6" aria-label="{{ __('Primary navigation', 'sage') }}">
      {!! \wp_nav_menu([
        'theme_location' => \has_nav_menu('primary_navigation') ? 'primary_navigation' : '',
        'menu'           => \has_nav_menu('primary_navigation') ? '' : 'Main Menu',
        'container'      => false,
        'menu_class'     => 'flex items-center gap-6 [&_a]:text-slate-300 [&_a]:text-sm [&_a]:font-medium [&_a]:hover:text-white [&_a]:transition-colors',
        'echo'           => false,
        'fallback_cb'    => false,
      ]) !!}
    </nav>

  </div>
</header>
