<?php

if ( function_exists( 'the_field' ) ):
    echo "<p>";
    single_cat_title();
    echo "</p>";

    $alpha_current_term = get_queried_object();

    $alpha_term_id = get_field( 'term_thumbnail', $alpha_current_term );
    if ( $alpha_term_id ):
        $alpha_term_thumbnail_id = $alpha_term_id['id'];
        $alpha_term              = wp_get_attachment_image_src( $alpha_term_thumbnail_id );
    ?>
    <img src="<?php echo esc_url( $alpha_term[0] ); ?>" alt="">
    <?php else: ?>
<h2>Image is not found</h2>
<?php
    endif;
    else:
        _e( 'There are no content to show here', 'alpha' );
endif;
?>