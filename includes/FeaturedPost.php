<?php

declare(strict_types=1);

namespace MRH\FeaturedPost;

final class FeaturedPost
{
    /**
     * Static class object
     *
     * @var object
     */
    private static $instance;

    const version = '1.0.0';
    const domain    = 'mrhfp-featured-posts';

    /**
     * Private class constructor
     */
    private function __construct()
    {
        $this->define_constants();
        $this->init_hooks();
    }

    /**
     * Private class cloner
     */
    private function __clone()
    {
    }


    public static function instance(): FeaturedPost
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Defines the required constants
     *
     * @return void
     */
    public function define_constants(): void
    {
        define('MRHFP_VERSION', self::version);
        define('MRHFP_URL', plugins_url('', MRHFP_FILE));
        define('MRHFP_ASSETS', MRHFP_URL . '/assets');
        define('MRHFP_INCLUDES', MRHFP_PATH . '/includes');
        define('MRHFP_DOMAIN', self::domain);
    }
    /**
     * Initialize hooks
     * 
     * @return void
     */

    private function init_hooks(): void
    {
        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this, 'init_classes']);
    }

    /**
     * Updates info on plugin activation
     *
     * @return void
     */
    public function activate(): void
    {
        $activator = new Activator();
        $activator->run();
    }

    /**
     * Initializes the necessary classes for the plugin
     *
     * @return void
     */
    public function init_classes(): void
    {
        new Frontend();
        if (is_admin()) {
            new Admin();
        }
    }
}
