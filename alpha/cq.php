<?php
    // Template Name: Custom Query

    get_header();
?>
<?php get_template_part( "templates-parts/common/hero" );?>
<div class="posts">
    <?php
        $paged    = get_query_var( "paged" ) ? get_query_var( "paged" ) : 1;
        $posts_id = array( 792, 660, 682, 674, 644 );
        $posts_per_page = 2;
        $total = 9;

        $_p = get_posts( array(
            'posts_per_page' => $posts_per_page,
            'numberposts'    => $total,
            // 'post__in'       => $posts_id,
            'author__in'     => array(1),
            'orderby'        => 'post__in',
            'paged'          => $paged,
        ) );
        foreach ( $_p as $post ) {
            setup_postdata( $post );
        ?>
            <h2 class="text-center"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <div class="text-center">
                <?php the_post_thumbnail( 'medium' );?>
            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    <div class="container post-pagination mt-4">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <?php
                    echo paginate_links( array(
                        'total' => ceil( $total / $posts_per_page ),
                    ) );
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>