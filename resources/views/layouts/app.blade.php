<!doctype html>
<html @php(language_attributes())>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @php(do_action('get_header'))
  @php(wp_head())

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body @php(body_class('bg-slate-950 text-slate-300 antialiased min-h-screen flex flex-col'))>
  @php(wp_body_open())

  <x-nav :menu="$primaryMenu ?? []" />

  <main id="main" class="main">
    @yield('content')
  </main>

  <x-footer />

  @php(wp_footer())
  @stack('scripts')
</body>

</html>