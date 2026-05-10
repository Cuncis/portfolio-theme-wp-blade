{{-- partials/pagination.blade.php --}}
@if(($totalPages ?? 1) > 1)
  <nav class="flex justify-center" aria-label="{{ __('Posts navigation', 'sage') }}">
    <div class="flex items-center gap-1 [&_.page-numbers]:flex [&_.page-numbers]:items-center [&_.page-numbers]:justify-center [&_.page-numbers]:w-10 [&_.page-numbers]:h-10 [&_.page-numbers]:rounded-lg [&_.page-numbers]:text-sm [&_.page-numbers]:font-medium [&_.page-numbers]:text-slate-400 [&_.page-numbers]:border [&_.page-numbers]:border-slate-800 [&_.page-numbers]:hover:border-slate-600 [&_.page-numbers]:hover:text-white [&_.page-numbers]:transition-colors [&_.page-numbers.current]:bg-indigo-600 [&_.page-numbers.current]:border-indigo-600 [&_.page-numbers.current]:text-white">
      {!! \paginate_links([
        'total'     => $totalPages,
        'current'   => max(1, \get_query_var('paged')),
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
      ]) !!}
    </div>
  </nav>
@endif
