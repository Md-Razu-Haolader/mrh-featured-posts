<?php

declare( strict_types=1 );

namespace MRH\FeaturedPost;

class Admin {

    public function __construct() {
        new Admin\Menu();
        new Admin\SettingsRegister();
    }
}
