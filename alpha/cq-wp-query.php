<?php
    // Template Name: Custom Query New Wp Query
    get_header();
?>
<?php get_template_part( "templates-parts/common/hero" );?>
<?php if(get_current_user_id() != 0 ): ?>
<div class="posts">
    <?php
        $paged    = get_query_var( "paged" ) ? get_query_var( "paged" ) : 1;
        $posts_id = array( 674, 644, 792, 660, 682 );
        $posts_per_page = 3;

        $query = new WP_Query( array(
            'category_name'  => 'technology',
            'author'         => get_current_user_id(),
            'posts_per_page' => $posts_per_page,
            'orderby'        => 'DESC',
            'paged'          => $paged,
        ) );
        while($query->have_posts()){
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
                        'total' => $query->max_num_pages,
                        'current' => $paged
                    ) );
                ?>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="text-center mb50 user-must-login">
    <h2 class="text-danger"><?php _e('You Must Need to Login to see this page content', 'alpha'); ?></h2>
</div>
<?php endif; ?>
<?php get_footer();?>