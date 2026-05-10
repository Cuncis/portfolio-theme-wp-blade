<?php
// app/View/Composers/FrontPage.php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontPage extends Composer
{
    protected static $views = ['front-page'];

    public function with(): array
    {
        $getField = function_exists('get_field') ? '\\get_field' : fn($key) => null;

        return [
            'hero' => $getField('hero'),
            'services' => $getField('services'),
            'recentPosts' => $this->getRecentPosts(),
            'recentWork' => $this->getRecentWork(),
        ];
    }

    protected function getRecentPosts(): array
    {
        return \get_posts([
            'numberposts' => 3,
            'post_status' => 'publish',
        ]);
    }

    protected function getRecentWork(): array
    {
        return \get_posts([
            'post_type' => 'portfolio',
            'numberposts' => 4,
            'post_status' => 'publish',
        ]);
    }
}