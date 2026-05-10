{{-- partials/pagination.blade.php --}}
@if(($totalPages ?? 1) > 1)
  <nav class="pagination" aria-label="{{ __('Posts navigation', 'sage') }}">
    {!! \paginate_links([
      'total'     => $totalPages,
      'current'   => max(1, \get_query_var('paged')),
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
    ]) !!}
  </nav>
@endif
