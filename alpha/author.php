<?php get_header(); ?>
<?php get_template_part("templates-parts/common/hero"); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="posts">
    <?php
        while ( have_posts() ){
            the_post();
			get_template_part('post-formats/content', get_post_format());
		}
	?>
    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <?php
                    the_posts_pagination( array(
                        'screen_reader_text' => ' ',
                        'prev_text'          => 'Prev',
                        'next_text'          => 'Next',
                    ) );
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>