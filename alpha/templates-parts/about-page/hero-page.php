<div class="header page-header">
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
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
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
    </div>
</div>