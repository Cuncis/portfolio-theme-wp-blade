---
name: sage-blade-wordpress
description: >
  WordPress theme development with Roots Sage (Acorn + Blade). Use for creating
  View Composers, Blade components, partials, layouts, and pages. Covers common
  pitfalls: PHP namespace errors, ACF get_field(), missing @endsection, WP-CLI
  database issues, archive title HTML, missing components, and Tailwind v4 styling.
argument-hint: 'Describe the view, composer, or component to build'
---

# Sage + Blade WordPress Theme Development

## Stack Overview
- **Sage** (Roots) — WordPress starter theme
- **Acorn** — Laravel-style framework layer (Blade, IoC, Artisan-equivalent via `wp acorn`)
- **Blade** — Laravel templating engine
- **Tailwind CSS v4** — utility-first CSS via `@tailwindcss/vite`
- **Vite** — asset bundler

---

## Critical Rules (Lessons Learned)

### 1. Always Prefix WordPress Functions with `\` in Composers

View Composers live in the `App\View\Composers` namespace. WordPress global functions
(`get_the_title()`, `get_posts()`, etc.) must be prefixed with `\` or PHP will look for
them inside the namespace and throw `Call to undefined function`.

```php
// ❌ WRONG — will throw "Call to undefined function"
'title' => get_the_title(),

// ✅ CORRECT
'title' => \get_the_title(),
```

Apply to: `get_the_title()`, `get_posts()`, `get_permalink()`, `get_the_content()`,
`apply_filters()`, `wp_get_post_categories()`, `get_the_date()`, `get_the_author()`,
`get_the_category()`, `get_the_archive_title()`, `paginate_links()`, `wp_nav_menu()`,
`home_url()`, `get_bloginfo()`, `has_post_thumbnail()`, `get_the_post_thumbnail_url()`,
`wp_strip_all_tags()`, `has_nav_menu()`, `wp_get_nav_menu_name()`, and all other WP functions.

---

### 2. Guard ACF `get_field()` with `function_exists()`

ACF (`get_field()`) is a plugin function — it won't exist if ACF is not installed or activated.
Always guard calls to prevent fatal errors.

```php
// ❌ WRONG — fatal if ACF not active
'client' => \get_field('client_name'),

// ✅ CORRECT — in Composers
$getField = \function_exists('get_field')
    ? fn($key) => \get_field($key)
    : fn($key) => null;

return [
    'client' => $getField('client_name'),
];

// ✅ CORRECT — in Blade views/components
@if(\function_exists('get_field') && $client = \get_field('client_name', $item->ID))
  <span>{{ $client }}</span>
@endif
```

---

### 3. Composer Files Must Be Complete PHP Classes

Every file in `app/View/Composers/` must be a full PHP class — never a partial snippet.

```php
// ✅ Required structure for every Composer
<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class MyComposer extends Composer
{
    protected static $views = ['my-view'];

    public function with(): array
    {
        return [
            'title' => \get_the_title(),
        ];
    }
}
```

Missing `<?php`, `namespace`, `use`, or `class` → PHP parse error.

---

### 4. Blade Views Must Have Matching `@section` / `@endsection`

Every `@section('name')` must have exactly one `@endsection`. A duplicate or missing
`@endsection` causes: `Cannot end a section without first starting one`.

```blade
{{-- ✅ CORRECT --}}
@extends('layouts.app')

@section('content')
  <p>Content here</p>
@endsection

{{-- ❌ WRONG — duplicate causes fatal error --}}
@endsection
@endsection
```

---

### 5. Create Blade Components Before Using `<x-name />`

Using `<x-nav />`, `<x-footer />`, or any `<x-component />` tag without the corresponding
`resources/views/components/name.blade.php` file causes:
`Unable to locate a class or view for component [name]`.

Always create the file first. Minimal component structure:

```blade
{{-- resources/views/components/my-component.blade.php --}}
@props(['prop' => null])

<div>
  {{ $prop }}
</div>
```

---

### 6. WordPress Archive Title Returns HTML — Strip Tags

`get_the_archive_title()` returns HTML like `Archives: <span>Portfolio</span>`.
Outputting with `{{ }}` in Blade will escape the tags and show them as visible text.

```php
// ❌ Shows: Archives: <span>Portfolio</span> as raw text in Blade {{ }}
'archiveTitle' => \get_the_archive_title(),

// ✅ Strip to plain text in the Composer
'archiveTitle' => \wp_strip_all_tags(\get_the_archive_title()),

// ✅ OR render the HTML in Blade
{!! $archiveTitle !!}
```

---

### 7. WordPress Menu Locations vs Menu Names

`wp_nav_menu()` with only `'theme_location'` returns nothing if the menu hasn't been
assigned to that location in WP Admin (Appearance → Menus → Manage Locations).

Use a conditional fallback to the menu name for development:

```php
\wp_nav_menu([
    'theme_location' => \has_nav_menu('primary_navigation') ? 'primary_navigation' : '',
    'menu'           => \has_nav_menu('primary_navigation') ? '' : 'Main Menu',
    'container'      => false,
    'echo'           => false,
    'fallback_cb'    => false,
])
```

Always remind user to: **Appearance → Menus → Manage Locations** to assign menus permanently.

---

### 8. WP-CLI / `wp acorn` Requires Local's Shell

Running `wp acorn make:component Foo` or `wp acorn` in the system terminal fails with
`Error establishing a database connection` because Local Sites isolates the DB.

**Solutions:**
- Use **Open Site Shell** in the Local app (runs inside the site's environment)
- Or create files manually — there is no `make:view` command anyway (views are plain Blade files)

---

### 9. Tailwind v4 Blade Component Classes

In Tailwind v4, classes used inside `@php` blocks or PHP strings are not automatically
detected. Ensure `@source` in `app.css` covers all Blade and PHP files:

```css
@import "tailwindcss" theme(static);
@source "../../app/**/*.php";
@source "../**/*.blade.php";
@source "../**/*.js";
```

For classes built dynamically in PHP (e.g. in `button.blade.php` variant maps), use
full class strings — never construct partial class names:

```php
// ❌ Tailwind won't detect dynamic construction
'bg-' . $color . '-600'

// ✅ Full strings only
'bg-indigo-600 text-white hover:bg-indigo-500'
```

---

### 10. Remove Link Underlines Globally

Browser defaults and WordPress styles add underlines to `<a>` tags. Tailwind's `no-underline`
utility may not override them. Use `!important` in the base layer:

```css
@layer base {
  a {
    text-decoration: none !important;
  }
}
```

---

## File Structure Reference

```
app/
  View/
    Composers/
      Archive.php          # index, archive, home views
      FrontPage.php        # front-page view
      SinglePortfolio.php  # single-portfolio view
      SinglePost.php       # single view
      PortfolioArchive.php # archive-portfolio view

resources/views/
  layouts/
    app.blade.php          # main HTML shell (@yield('content'))
  components/
    nav.blade.php          # <x-nav> — sticky header
    footer.blade.php       # <x-footer>
    button.blade.php       # <x-button variant="primary|secondary|ghost">
    post-card.blade.php    # <x-post-card :post="$post">
    portfolio-card.blade.php # <x-portfolio-card :item="$item">
  partials/
    pagination.blade.php   # @include('partials.pagination')
  sections/                # (legacy) — not auto-included, include manually
  front-page.blade.php
  index.blade.php
  single.blade.php
  single-portfolio.blade.php
  page.blade.php
```

---

## Procedure: Create a View Composer

1. Create `app/View/Composers/MyView.php`
2. Add full class structure (namespace, use, class extends Composer)
3. Set `protected static $views = ['my-view']` matching the Blade filename without `.blade.php`
4. In `with()`, prefix all WP functions with `\`
5. Guard any plugin functions (ACF, WooCommerce, etc.) with `function_exists()`
6. Register it in `app/Providers/ThemeServiceProvider.php` if not auto-discovered

## Procedure: Create a Blade Component

1. Create `resources/views/components/my-component.blade.php`
2. Declare props with `@props([...])`
3. Prefix all WP functions with `\` inside `{{ }}` expressions
4. Use `{!! !!}` only for trusted HTML (WP functions like `wp_nav_menu`, `the_content`)
5. Use `{{ }}` for all user-generated or escaped output
6. Use `@if(\function_exists('get_field'))` for any ACF calls

## Procedure: Create a Page Template

1. Create `resources/views/my-template.blade.php`
2. Start with `@extends('layouts.app')`
3. Wrap content in exactly one `@section('content') ... @endsection`
4. Create a matching Composer if data is needed

---

## Quality Checklist

- [ ] All WP functions prefixed with `\` in Composers and components
- [ ] `function_exists('get_field')` guard on all ACF calls
- [ ] Every Composer file has `<?php`, `namespace`, `use`, `class extends Composer`
- [ ] Every `@section` has exactly one matching `@endsection`
- [ ] Every `<x-component>` has a corresponding `.blade.php` file
- [ ] `get_the_archive_title()` stripped with `wp_strip_all_tags()`
- [ ] `wp_nav_menu()` uses `has_nav_menu()` conditional for location fallback
- [ ] `npm run build` passes after changes
- [ ] Blade view cache cleared after Composer changes: `rm -rf wp-content/cache/acorn/framework/views/`
- [ ] Tailwind classes written as full strings, not dynamically constructed
- [ ] `text-decoration: none !important` in base layer to kill browser link underlines
