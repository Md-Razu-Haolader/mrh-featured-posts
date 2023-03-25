<?php

declare(strict_types=1);

namespace MRH\FeaturedPost;

use MRH\FeaturedPost\Frontend\Shortcode;
use MRH\FeaturedPost\Frontend\PostViewHandler;

/**
 * Frontend handler class
 */
class Frontend
{

    /**
     * Frontend class constructor
     */
    public function __construct()
    {
        new Shortcode();
    }
}
