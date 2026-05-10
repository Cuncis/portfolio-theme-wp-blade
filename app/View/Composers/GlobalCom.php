<?php
// app/View/Composers/Global.php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class GlobalCom extends Composer
{
    protected static $views = ['*'];

    public function with(): array
    {
        return [
            'siteTitle' => get_bloginfo('name'),
            'siteDesc' => get_bloginfo('description'),
            'primaryMenu' => $this->getMenu('primary_navigation'),
            'footerMenu' => $this->getMenu('footer_navigation'),
        ];
    }

    protected function getMenu(string $location): string
    {
        return wp_nav_menu([
            'theme_location' => $location,
            'echo' => false,
            'container' => false,
        ]) ?: '';
    }
}