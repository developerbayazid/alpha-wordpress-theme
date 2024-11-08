<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
               <?php 
               if(is_active_sidebar('footer-left')){
                   dynamic_sidebar('footer-left');
               }
               ?>
            </div>
            <div class="col-md-6">
                <?php 
                if(is_active_sidebar('footer-right')){
                    dynamic_sidebar('footer-right');
                }
                ?>
                <div>
                    <p>
                        <?php 
                        wp_nav_menu(array(
                            'theme_location' => 'footer_menu',
                            'menu_class' => 'list-inline text-center',
                            'menu_id' => 'footer_menu',
                        ));
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer();?>
</body>
</html>