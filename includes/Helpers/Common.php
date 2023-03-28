<?php

declare( strict_types=1 );

namespace MRH\FeaturedPost\Helpers;

class Common {

    /**
     * Emphasize texts with <em> tag
     *
     * @param mixed $value
     * @param mixed $extension
     */
    public static function emphasize_text( $value, $extension = null ): string {
        ob_start();

        ?>
        <em><?php echo "$value $extension"; ?></em>
<?php

                $result = ob_get_clean();

        return $result;
    }

    /**
     * makes custom post excerps from post
     */
    public static function custom_excerpt( object $post, int $length = 200 ): string {
        if ( $post->post_excerpt !== '' ) {
            $excerpt = $post->post_excerpt;
        } else {
            $excerpt = strip_tags( $post->post_content );
        }

        if ( strlen( $excerpt ) > $length ) {
            $excerpt  = substr( $excerpt, 0, $length );
            $excerpt .= ' . . .<a href="' . get_permalink( $post ) . '"><em>continue reading</em></a>';
        }

        return $excerpt;
    }

    /**
     * Counts the number of posts
     */
    public static function get_post_count(): int {
        return (int) wp_count_posts( 'post' )->publish;
    }

    /**
     * Retrieves the available post categories
     */
    public static function get_post_categories(): array {
        $terms = get_terms( [
            'taxonomy'   => 'category',
            'hide_empty' => false,
        ] );

        return $terms;
    }

    /**
     * Renders number of posts dropdown
     */
    public static function generate_number_posts_dropdown( array $args ): void {
        $field_id    = $args['label_for'];
        $total_posts = static::get_post_count();
        $value       = get_option( $field_id );

        if ( !$value ) {
            $value = $args['number_posts'];
        }

        printf( "<select name='%s' id='%s'>", $field_id, $field_id );

        for ( $i = 1; $i <= $total_posts; ++$i ) {
            $selected = '';

            if ( $i === $value ) {
                $selected = 'selected';
            }

            printf( '<option value=%d %s>%d</option>', $i, $selected, $i );
        }

        printf( '</select>' );
    }

    /**
     * Renders checkbox for category
     */
    public static function generate_category_checkbox( array $args ): void {
        $field_id   = $args['label_for'];
        $categories = static::get_post_categories();
        $values     = get_option( $field_id );

        foreach ( $categories as $category ) {
            $checked = '';

            if ( is_array( $values ) && in_array( $category->term_id, $values, true ) ) {
                $checked = 'checked';
            }

            printf( "<input type='checkbox' name=%s id=%s value=%d %s />%s<br/>", $field_id . '[]', $field_id, $category->term_id, $checked, $category->name );
        }
    }

    /**
     * Renders order dropdown list
     */
    public static function generate_order_dropdown( array $args ): void {
        $field_id     = $args['label_for'];
        $orders       = $args['orders'];
        $option_value = get_option( $field_id );

        if ( !$option_value ) {
            $option_value = $orders['Descending'];
        }

        printf( "<select name='%s' id='%s'>", $field_id, $field_id );

        foreach ( $orders as $order => $value ) {
            $selected = '';

            if ( $value === $option_value ) {
                $selected = 'selected';
            }

            printf( '<option value=%s %s>%s</option>', $value, $selected, $order );
        }

        printf( '</select>' );
    }
}
