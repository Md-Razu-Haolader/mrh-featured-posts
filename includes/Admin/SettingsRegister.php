<?php

declare( strict_types=1 );

namespace MRH\FeaturedPost\Admin;

use MRH\FeaturedPost\Helpers\Common;

class SettingsRegister {

    const settings_page    = 'mrhfp-featured-posts';
    const settings_section = 'mrhfp_settings';

    public function __construct() {
        add_action( 'admin_init', [$this, 'settings_page_init'] );
    }

    /**
     * Initializes settings page
     *
     * @return void
     */
    public function settings_page_init() {
        register_setting( self::settings_page, 'mrhfp_number_posts' );
        register_setting( self::settings_page, 'mrhfp_categories' );
        register_setting( self::settings_page, 'mrhfp_order' );

        add_settings_section(
            self::settings_section,
            __( 'Featured Posts Settings', MRHFP_DOMAIN ),
            [$this, 'add_settings_fields'],
            self::settings_page
        );
    }

    /**
     * Defines the settings fields
     *
     * @return void
     */
    public function add_settings_fields() {
        add_settings_field(
            'mrhfp_number_posts',
            __( 'Number of posts', MRHFP_DOMAIN ),
            [Common::class, 'generate_number_posts_dropdown'],
            self::settings_page,
            self::settings_section,
            [
                'label_for'    => 'mrhfp_number_posts',
                'number_posts' => 10,
            ]
        );

        add_settings_field(
            'mrhfp_categories',
            __( 'Select Categories', MRHFP_DOMAIN ),
            [Common::class, 'generate_category_checkbox'],
            self::settings_page,
            self::settings_section,
            ['label_for'  => 'mrhfp_categories']
        );

        add_settings_field(
            'mrhfp_order',
            __( 'Select Order', MRHFP_DOMAIN ),
            [Common::class, 'generate_order_dropdown'],
            self::settings_page,
            self::settings_section,
            [
                'label_for' => 'mrhfp_order',
                'orders'    => [
                    'Ascending'  => 'asc',
                    'Descending' => 'desc',
                    'Random'     => 'rand',
                ],
            ]
        );
    }
}
