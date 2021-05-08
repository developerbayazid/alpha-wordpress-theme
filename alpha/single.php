<?php 
$alpha_single_post_layout = "col-md-8";
$alpha_text_align = '';
if(!is_active_sidebar('sidebar-1')){
    $alpha_single_post_layout = "col-md-10 offset-md-1";
    $alpha_text_align = "text-center";
}
?>
<?php get_header(); ?>
<body <?php body_class();?> >
<?php get_template_part("templates-parts/common/hero"); ?>
<div class="container">
    <div class="row">
        <div class="<?php echo $alpha_single_post_layout; ?>">
            <div class="posts">
                <?php
                while ( have_posts() ):
                    the_post();
                ?>
                <div <?php post_class();?> >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 <?php echo $alpha_text_align; ?>">
                                <h2 class="post-title">
                                    <?php the_title();?>
                                </h2>
                                <div>
                                    <strong><?php the_author_posts_link();?></strong><br/>
                                    <?php echo get_the_date(); ?>
                                    <?php echo get_the_tag_list( '<ul class="list-unstyled"><li>', '</li><li>', '</li></ul>' ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slider">
                                    <?php
                                    if ( class_exists( 'Attachments' ) ) {
                                        $attachments = new Attachments( 'slider' );
                                        if ( $attachments->exist() ) {
                                            while ( $attachment = $attachments->get() ) { ?>
                                                <div>
                                                    <?php echo $attachments->image( 'large' ); ?>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <p>
                                <?php
                                    if ( !class_exists( 'Attachments' ) ) {
                                        if ( has_post_thumbnail() ) {
                                            $thumbnail_url = get_the_post_thumbnail_url(null, 'large');
                                            printf('<a href="%s" data-featherlight="image">', $thumbnail_url);
                                            the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) );
                                        }
                                    }

                                    echo '</a>';
                                    // next_post_link();
                                    // echo "<br>";
                                    // previous_post_link();
                                ?>
                                </p>

                                <?php 
                                the_content();


                                // Imgae Format Post

                                if(get_post_format() == 'image' && function_exists('the_field')):
                                    $alpha_camera_model =  get_field('camera_model');
                                    $alpha_location = get_field('location');
                                    $alpha_date = get_field('date');
                                    $alpha_license = get_field('licensed');
                                    $alpha_license_inforamtion = get_field('license_information');
                                ?>
                                <?php if($alpha_camera_model || $alpha_location || $alpha_date || $alpha_license || $alpha_license_inforamtion): ?>
                                <div class="single_meta_information">
                                    <p>
                                        <?php if($alpha_camera_model): ?>
                                        <span>
                                            <strong><?php _e('Camera Model: ', 'alpha'); ?> </strong>
                                            <?php echo esc_html($alpha_camera_model); ?>
                                        </span><br>
                                        <?php endif; ?>
                                        <?php if($alpha_location): ?>
                                        <span>
                                            <strong><?php _e('Location: ', 'alpha'); ?> </strong>
                                            <?php echo esc_html($alpha_location); ?>
                                        </span><br>
                                        <?php endif; ?>
                                        <?php if($alpha_date): ?>
                                        <span>
                                            <strong><?php _e('Date: ', 'alpha'); ?> </strong>
                                            <?php echo esc_html($alpha_date); ?>
                                        </span><br>
                                        <?php endif; ?>
                                        <?php if(esc_html($alpha_license)): ?>
                                        <span>
                                            <strong><?php _e('License Information: ', 'alpha'); ?> </strong>
                                            <?php echo esc_html($alpha_license_inforamtion); ?>
                                        </span>
                                        <?php endif; ?>
                                    </p>
                                    <?php 
                                    $alpha_image = get_field('image');
                                    if($alpha_image):
                                    $alpha_img_src = wp_get_attachment_image_src($alpha_image, 'thumbnail');
                                    ?>
                                    <img src="<?php echo esc_url($alpha_img_src[0]); ?>" alt="">
                                    <br><br>
                                    <?php endif; ?>                  
                                    
                                    <p>
                                        
                                        <?php
                                        $alpha_file = get_field('attachment'); 
                                        if($alpha_file){
                                            $alpha_file_url = wp_get_attachment_url($alpha_file);
                                            $alpha_file_thumb = get_field('thumbnail', $alpha_file);
                                            $alpha_file_thumb_src = wp_get_attachment_image_src($alpha_file_thumb);
                                            if($alpha_file_thumb){
                                                ?>
                                                    <p><strong><?php _e('Click Image to Download PDF', 'alpha'); ?></strong></p>
                                                    <a target="_blank" href="<?php echo esc_url($alpha_file_url); ?>"><img src="<?php echo esc_url($alpha_file_thumb_src[0]); ?>" alt=""></a>
                                                <?php
                                            }else{
                                                ?>
                                                    <a target="_blank" href="<?php echo esc_url($alpha_file_url); ?>"><?php _e('Click here to download PDF File', 'alpha'); ?></a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </p>


                                </div>
                
                                <?php
                                endif;
                                endif;
                                wp_link_pages(); 
                                ?>
                                <?php if(function_exists('the_field') && get_field('related_posts')): ?>
                                <div class="related_posts">
                                    <h2><?php _e('Related Posts', 'alpha'); ?></h2>
                                    <?php 
                                    $related_posts = get_field('related_posts');

                                   $query = new WP_Query(array(
                                       'post__in' => $related_posts,
                                       'orderby' => 'post__in'
                                   ));

                                   while($query->have_posts()){
                                       $query->the_post();
                                       ?>
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                       <?php
                                   }
                                  
                                    ?>
                                </div>
                                <?php endif; ?>


                            <!-- Audio Format Field -->
                        
                                <?php 
                                    if(get_post_format() == 'audio' && class_exists('CMB2')): 
                                        $_alpha_camera_model = get_post_meta(get_the_ID(), '_alpha_camera_model', true);
                                        $_alpha_location = get_post_meta(get_the_ID(), '_alpha_location', true);
                                        $_alpha_date = get_post_meta(get_the_ID(), '_alpha_date', true);
                                        $_alpha_licensed_ = get_post_meta(get_the_ID(), '_alpha_licensed_', true);
                                        $_alpha_license_information = get_post_meta(get_the_ID(), '_alpha_license_information', true);
                                        $_alpha_image = get_post_meta(get_the_ID(), '_alpha_image_id', true);
                                        $_alpha_resume_id = get_post_meta(get_the_ID(), '_alpha_resume_id', true);

                                        
                                    ?>
                                        <?php if($_alpha_camera_model || $_alpha_location || $_alpha_date || $_alpha_licensed_ || $_alpha_license_information || $_alpha_image || $_alpha_resume_id): ?>
                                            <div class="single_meta_information">

                                                <?php if($_alpha_camera_model): ?>
                                                <span>
                                                    <strong><?php _e('Camera Model: ', 'alpha'); ?> </strong>
                                                    <?php echo esc_html($_alpha_camera_model); ?>
                                                </span><br>
                                                <?php endif; ?>

                                                <?php if($_alpha_location): ?>
                                                <span>
                                                    <strong><?php _e('Location: ', 'alpha'); ?> </strong>
                                                    <?php echo esc_html($_alpha_location); ?>
                                                </span><br>
                                                <?php endif; ?>

                                                <?php if($_alpha_date): ?>
                                                <span>
                                                    <strong><?php _e('Date: ', 'alpha'); ?> </strong>
                                                    <?php echo esc_html($_alpha_date); ?>
                                                </span><br>
                                                <?php endif; ?>

                                                <?php if($_alpha_licensed_ && $_alpha_license_information): ?>
                                                <span>
                                                    <strong><?php _e('License: ', 'alpha'); ?> </strong>
                                                    <?php echo esc_html($_alpha_license_information); ?>
                                                </span><br>
                                                <?php endif; ?>
                                                <p>
                                                    <?php 
                                                        $_alpha_image_src = wp_get_attachment_image_src( $_alpha_image );
                                                        if($_alpha_image_src):
                                                            ?>
                                                                <img src="<?php echo esc_url($_alpha_image_src[0]); ?>" alt="">
                                                            <?php
                                                        endif;
                                                    ?>
                                                </p>
                                                <p>
                                                    <?php 
                                                        $_alpha_resume_src = wp_get_attachment_url( $_alpha_resume_id );
                                                        if($_alpha_resume_id):
                                                            ?>
                                                                <a target="_blank" href="<?php echo esc_url($_alpha_resume_src); ?>"><?php _e('Download Resume', 'alpha'); ?></a>
                                                            <?php
                                                        endif;
                                                    ?>
                                                </p>

                                            </div>
                                        <?php endif; ?>

                                <?php 
                                    endif; ?>



                            </div>
                            <?php if(!post_password_required()): ?>
                            <div class="col-md-12">
                                <?php comments_template('/comments.php'); ?>
                            </div>
                            <?php endif; ?>
                            <div class="autho-section">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="author-image">
                                            <?php echo get_avatar(get_the_author_meta('ID')); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-9 text-left">
                                        <h3><?php echo get_the_author_meta('display_name');?></h3>
                                        <p><?php echo get_the_author_meta('description');?></p>
                                        <p>
                                            <?php 
                                            if(function_exists('the_field')){
                                                if(get_field('facebook', "user_".get_the_author_meta( 'ID' ))){
                                                    $facebook = get_field('facebook', "user_".get_the_author_meta( 'ID' ));
                                                    _e('<strong>Facebook: </strong>', 'alpha');
                                                    ?>
                                                    <a href="<?php echo esc_url($facebook); ?>"><?php echo esc_url($facebook); ?></a><br>
                                                    <?php
                                                }
                                                if(get_field('twitter', "user_".get_the_author_meta( 'ID' ))){
                                                    $twitter = get_field('twitter', "user_".get_the_author_meta( 'ID' ));
                                                    _e('<strong>twitter: </strong>', 'alpha');
                                                    ?>
                                                    <a href="<?php echo esc_url($twitter); ?>"><?php echo esc_url($twitter); ?></a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile;?>
            </div>
        </div>
        <?php if(is_active_sidebar('sidebar-1')): ?>
        <div class="col-md-4">
            <?php 
                if(is_active_sidebar('sidebar-1')){
                    dynamic_sidebar('sidebar-1');
                }  
            ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>