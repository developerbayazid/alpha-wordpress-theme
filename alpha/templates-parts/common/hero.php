<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(current_theme_supports("custom-logo")): ?>
                    <div class="custom-logo text-center">
                        <a href="<?php echo site_url(); ?>"><?php echo get_custom_logo(); ?></a>
                    </div>
                <?php endif; ?>
                <h3 class="tagline"><?php bloginfo( "description" );?></h3>
                <h1 class="align-self-center display-1 text-center heading"><a href="<?php echo site_url(); ?>"><?php bloginfo( "name" );?></a></h1>
                <h4 class="text-center"><?php echo alpha_today(); ?></h4>
            </div>
            <div class="col-md-12">
                <div class="navigation">
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'top_menu',
                            'menu_class'     => 'list-inline text-center',
                            'menu_id'        => 'top_menu',
                        ) );
                    ?>
                </div>
            </div>
            <div class="col-md-12 text-center mt50 mb50">
                <?php 
                if(is_search() && get_search_query() != ''){
                    _e('You search for: ', 'alpha');
                    ?>
                    <strong>
                    <?php
                    the_search_query();
                    ?>
                    </strong>
                    <?php
                }
                ?>
                <div class="search-form">
                    <?php echo get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
</div>