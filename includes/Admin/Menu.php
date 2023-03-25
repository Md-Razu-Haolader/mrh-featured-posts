<?php

namespace MRH\FeaturedPost\Admin;

class Menu
{

    const settings_page    = 'mrhfp-featured-posts';

    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Renders admin menu
     *
     * @return void
     */
    public function admin_menu()
    {
        add_options_page(
            __('MRH Featured Posts', MRHFP_DOMAIN),
            __('Featured Posts', MRHFP_DOMAIN),
            'manage_options',
            self::settings_page,
            [$this, 'settings_page'],
            0
        );
    }

    /**
     * Renders settings page
     *
     * @return void
     */
    public function settings_page()
    {
        if (!current_user_can('manage_options')) {
            return;
        }
?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields(self::settings_page);

                do_settings_sections(self::settings_page);

                submit_button(__('Save Settings', MRHFP_DOMAIN));
                ?>
            </form>
        </div>
<?php
    }
}
