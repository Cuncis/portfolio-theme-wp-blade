<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Archive extends Composer
{
    protected static $views = ['index', 'archive', 'home'];

    public function with(): array
    {
        global $wp_query;

        return [
            'posts' => $wp_query->posts,
            'totalPages' => $wp_query->max_num_pages,
            'archiveTitle' => \get_the_archive_title(),
        ];
    }
}