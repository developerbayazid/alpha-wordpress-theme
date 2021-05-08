<?php get_header(); ?>
<?php get_template_part("templates-parts/common/hero"); ?>
<div class="container">
    <?php if(is_front_page()){ ?>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="testimonials slider text-center">
                <?php
                if ( class_exists( 'Attachments') ) {
                    $attachments = new Attachments( 'testimonial', 712 );
                    if ( $attachments->exist() ) {
                        while ( $attachment = $attachments->get() ) { ?>
                            <div>
                                <?php echo $attachments->image( 'thumbnail' ); ?>
                                <h5><?php echo esc_html($attachments->field( 'name' )); ?></h5>
                                <p>
                                    <?php 
                                    echo esc_html($attachments->field( 'position' )); ?>,
                                    <strong>
                                        <?php echo esc_html($attachments->field( 'company' )); ?>
                                    </strong>
                                </p>
                                <p><?php echo esc_html($attachments->field( 'testimonial' )); ?></p>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="container">
    <?php if(is_front_page()){ ?> 
        <div class="row teams">
            <div class="team text-center">
            <?php
            if ( class_exists( 'Attachments' ) ) {
                $attachments = new Attachments( 'team', 712 );
                if ( $attachments->exist() ) {
                    while ( $attachment = $attachments->get() ) { ?>  
                        <div class="col-md-4 single-team">
                            <?php echo $attachments->image( 'medium' ); ?>
                            <h5><?php echo esc_html($attachments->field( 'name' )); ?></h5>
                            <p>
                                <?php 
                                echo esc_html($attachments->field( 'position' )); ?>,
                                <strong>
                                    <?php echo esc_html($attachments->field( 'company' )); ?>
                                </strong>
                            </p>
                            <p><?php echo esc_html($attachments->field( 'bio' )); ?></p>
                            <p><?php echo esc_html($attachments->field( 'email' )); ?></p>
                        </div>
                        <?php
                    }
                }
            }
            ?>
            </div>
        </div>
    <?php } ?>
</div>
<div class="posts">
    <?php
    while ( have_posts() ):
        the_post();
    ?>
    <div <?php post_class();?> >
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h2 class="post-title text-center">
                        <?php the_title();?>
                    </h2>
                    <div class="text-center">
                        <p>
                            <strong><?php the_author();?></strong><br/>
                            <?php echo get_the_date(); ?>
                            <?php echo get_the_tag_list( '<ul class="list-unstyled"><li>', '</li><li>', '</li></ul>' ); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <p>
                        <?php
                            if ( has_post_thumbnail() ) {
                                $thumbnail_url = get_the_post_thumbnail_url(null, 'large');
                                printf('<a href="%s" data-featherlight="image">', $thumbnail_url);
                                the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) );
                            }
                            echo '</a>';
                            next_post_link();
                            echo "<br>";
                            previous_post_link();
                        ?>
                    </p>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile;?>
</div>
        
<?php get_footer(); ?>