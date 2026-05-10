<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PortfolioArchive extends Composer
{
    protected static $views = ['archive-portfolio'];

    public function with(): array
    {
        return [
            'items' => \get_posts([
                'post_type' => 'portfolio',
                'numberposts' => -1,
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ]),
        ];
    }
}