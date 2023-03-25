<?php

declare(strict_types=1);

namespace MRH\FeaturedPost;

class Activator
{

    /**
     * Runs the activator
     *
     * @return void
     */
    public function run(): void
    {
        $this->add_plugin_info();
    }

    /**
     * Adds plugin info
     *
     * @return void
     */
    public function add_plugin_info(): void
    {
        $activated = get_option('mrhfp_installation_time');

        if (!$activated) {
            update_option('mrhfp_installation_time', time());
        }

        update_option('mrhfp_version', MRHFP_VERSION);
    }
}
