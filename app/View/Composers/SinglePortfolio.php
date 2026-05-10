<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SinglePortfolio extends Composer
{
    protected static $views = ['single-portfolio'];

    public function with(): array
    {
        $getField = \function_exists('get_field')
            ? fn($key) => \get_field($key)
            : fn($key) => null;

        return [
            'title' => \get_the_title(),
            'content' => \apply_filters('the_content', \get_the_content()),
            'client' => $getField('client_name'),
            'year' => $getField('project_year'),
            'services' => $getField('services_provided'),
            'gallery' => $getField('project_gallery'),
            'url' => $getField('project_url'),
        ];
    }
}
