<div <?php post_class();?> >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="post-title">
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p>
                    <strong><?php the_author_posts_link();?></strong><br/>
                    <?php echo get_the_date(); ?>
                </p>
                <?php //echo get_the_tag_list( '<ul class="list-unstyled"><li>', '</li><li>', '</li></ul>' ); ?>
                <?php echo '<span class="dashicons dashicons-format-image"></span><br><br><br>'; ?>
                <?php
                    /* translators: used between list items, there is a space after the comma */
                    $categories_list = get_the_category_list( __( ', ', 'alpha' ) );
                    
                    /* translators: used between list items, there is a space after the comma */
                    $tag_list = get_the_tag_list( '', __( ', ', 'alpha' ) );
                    if ( '' != $tag_list ) {
                        $utility_text = __( 'Category: %1$s <br> Tag: %2$s', 'alpha' );
                    } elseif ( '' != $categories_list ) {
                        $utility_text = __( 'Category: %1$s', 'alpha' );
                    } else {
                        $utility_text = __( 'Category and Tags not found', 'alpha' );
                    }
                    
                    printf(
                        $utility_text,
                        $categories_list,
                        $tag_list,
                        esc_url( get_permalink() ),
                        the_title_attribute( 'echo=0' ),
                        get_the_author(),
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
                    );
                ?>
            </div>
            <div class="col-md-8">
                <p>
                    <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) );
                        }
                    ?>
                </p>
                <?php
                the_excerpt();
                ?>
            </div>
        </div>

    </div>
</div>