{{-- partials/pagination.blade.php --}}
@if($totalPages > 1)
  <nav class="pagination" aria-label="Posts navigation">
    @php(echo paginate_links([
        'total'   => $totalPages,
        'current' => max(1, get_query_var('paged')),
    ]))
  </nav>
@endif