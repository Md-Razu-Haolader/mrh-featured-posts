<?php declare( strict_types=1 );
get_header();

use MRH\FeaturedPost\Helpers\Common;

?>

<div id="primary" class="content-area" style="padding-top:5px">
    <main id="main" class="site-main">

        <?php
        foreach ( $featured_posts as $post ) {
            setup_postdata( $post );
            ?>
            <h2 class="entry-title">
                <a href="<?php echo get_permalink( $post ); ?>" title="<?php echo get_the_title( $post ); ?>" rel="bookmark"><?php echo get_the_title( $post ); ?></a>
            </h2>

            <div>
                <?php echo Common::custom_excerpt( $post, 100 ); ?>
            </div>
            <hr>
        <?php
                wp_reset_postdata();
        }
?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
