<?php

use ParagonIE\Sodium\Core\Curve25519\Ge\P2;

get_header(); ?>
<?php get_template_part("templates-parts/common/hero"); ?>
<div class="posts">
    <h2 class="text-center mb50">
        Posts In
        <?php 
            if(is_month()){
                $month = get_query_var('monthnum');
                $dateObject = DateTime::createFromFormat("!m", $month);
                echo $dateObject->format('F');
            }else if(is_year()){
                echo esc_html(get_query_var('year'));
            }else if(is_day()){
                $day = esc_html(get_query_var('day'));
                $month = esc_html(get_query_var('monthnum'));
                $year = esc_html(get_query_var('year'));
                printf("%s/%s/%s", $day, $month, $year);
            }
        ?>
    </h2>
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