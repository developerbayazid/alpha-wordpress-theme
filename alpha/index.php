<?php get_header(); ?>
<?php get_template_part("templates-parts/common/hero"); ?>
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