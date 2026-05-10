<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SinglePost extends Composer
{
    protected static $views = ['single'];

    public function with(): array
    {
        return [
            'title' => \get_the_title(),
            'content' => \apply_filters('the_content', \get_the_content()),
            'date' => \get_the_date('F j, Y'),
            'author' => \get_the_author(),
            'categories' => \get_the_category(),
            'related' => $this->getRelatedPosts(),
        ];
    }

    protected function getRelatedPosts(): array
    {
        $cats = \wp_get_post_categories(\get_the_ID());

        return \get_posts([
            'category__in' => $cats,
            'post__not_in' => [\get_the_ID()],
            'numberposts' => 2,
        ]);
    }
}