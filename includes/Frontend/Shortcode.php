<?php

declare(strict_types=1);

namespace MRH\FeaturedPost\Frontend;

use MRH\FeaturedPost\Helpers\Template;
use MRH\FeaturedPost\Helpers\Common;

class Shortcode
{

    public function __construct()
    {
        add_shortcode('mrhfp', [$this, 'render_shortcode']);
    }

    public function render_shortcode($atts, string $content = '')
    {
        $args = $this->preparePostQueryArgs();
        $featured_posts = get_posts($args);
        ob_start();

        if ($featured_posts) {
            Template::render(
                MRHFP_INCLUDES . '/Frontend/views/featured-archive.php',
                ['featured_posts' => $featured_posts]
            );
        }

        $content = ob_get_clean();
        return $content;
    }

    private function preparePostQueryArgs(): array
    {
        $terms    = Common::get_post_categories();
        $term_ids = array_column($terms, 'term_id');
        $order = get_option('mrhfp_order', 'desc');
        $order_by = '';
        if ($order == 'rand') {
            $order_by = $order;
            $order    = '';
        }

        return [
            'numberposts'  => get_option('mrhfp_number_posts', 10),
            'category__in' => get_option('mrhfp_categories', $term_ids),
            'order'        => $order,
            'orderby'      => $order_by,
        ];
    }
}
