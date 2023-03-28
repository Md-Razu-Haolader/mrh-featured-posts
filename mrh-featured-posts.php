<?php

declare( strict_types=1 );
/**
 * Plugin Name:       Featured Post
 * Plugin URI:        razu.cse129@gmail.com
 * Description:       A plugin to add add a settings page under settings menu, and a shortcode to show featured posts by using filters from the settings page.
 * Version:           1.0.0
 * Requires at least: 6.1
 * Requires PHP:      8.2
 * Author:            Md. Razu Haolader
 * Author URI:        https://www.linkedin.com/in/md-razu-haolader/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mrh-featured-posts
 *
 * Copyright (c) 2023 Md. Razu Haolader (razu.cse129@gmail.com). All rights reserved.
 *
 * This program is a free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see the License URI.
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use MRH\FeaturedPost\FeaturedPost;

define( 'MRHFP_FILE', __FILE__ );
define( 'MRHFP_PATH', __DIR__ );
/**
 * Initializes the main plugin
 */
function feature_posts(): FeaturedPost {
    return FeaturedPost::instance();
}

//kick off the plugin
feature_posts();
