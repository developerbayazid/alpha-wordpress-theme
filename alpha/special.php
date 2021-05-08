<?php
    // Template Name: Special Post
    get_header();
?>
<?php get_template_part( "templates-parts/common/hero" );?>
<div class="posts">
    <?php
        $paged          = get_query_var( "paged" ) ? get_query_var( "paged" ) : 1;
        $posts_per_page = 3;

        
        // $query = new WP_Query( array(
        //     'posts_per_page' => $posts_per_page,
        //     'orderby'        => 'DESC',
        //     'paged'          => $paged,
        //     'post_type'      => 'post',
        //     'tax_query'      => array(
        //         'relation' => 'AND',
        //         array(
        //             'taxonomy' => 'category',
        //             'field'    => 'slug',
        //             'terms'    => array( 'technology' ),
        //         ),
        //         array(
        //             'relation' => 'AND',
        //             array(
        //                 'taxonomy' => 'post_format',
        //                 'field'    => 'slug',
        //                 'terms'    => array(
        //                     'post-format-audio',
        //                     'post-format-video',
        //                     'post-format-quote',
        //                     'post-format-image',
        //                     'post-format-link',
        //                  ),
        //             ),
        //             // array(
        //             //     'taxonomy' => 'category',
        //             //     'field'    => 'slug',
        //             //     'terms'    => array( 'popular' ),
        //             // ),
        //         ),
        //     ),
        // ) );

        $query = new WP_Query( array(
            'posts_per_page' => $posts_per_page,
            'orderby'        => 'DESC',
            'paged'          => $paged,
            'post_type'      => 'post',
            'meta_query'     => array(
                'relation' => 'AND',
                array(
                    'key'     => 'feature',
                    'value'   => 1,
                    'compare' => '=',
                ),
                array(
                    'key'     => 'homepage',
                    'value'   => 1,
                    'compare' => '=',
                ),
            ),
        ) );

        while ( $query->have_posts() ) {
            $query->the_post();
        ?>
        <h2 class="text-center"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
        <div class="text-center">
            <?php the_post_thumbnail( 'medium' );?>
        </div>
        <?php
            }
            wp_reset_query();
        ?>
    <div class="container post-pagination mt-4">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <?php
                    echo paginate_links( array(
                        'total'   => $query->max_num_pages,
                        'current' => $paged,
                    ) );
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>