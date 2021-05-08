<?php
/**
 * Template Name: Pricing Table
 */
get_header();
get_template_part('templates-parts/common/hero');
?>
<div class="container">
    <div class="row pricing_table">
        <?php 
            $alpha_pricing_table = get_post_meta(get_the_ID(),'_pricing_table_');
            foreach($alpha_pricing_table as $alpha_pts):
                foreach($alpha_pts as $alpha_pt):
                    ?>

                    <div class="col-md-4 pricing-table-item">
                        <h2><?php echo esc_html($alpha_pt['pt_title']); ?></h2>
                        <?php  
                            $alpha_options = $alpha_pt['pt_option'];
                            foreach($alpha_options as $alpha_option):
                                ?>
                                    <p><?php echo esc_html($alpha_option); ?></p>
                                <?php
                            endforeach;
                        ?>
                        <h2><?php echo "$".esc_html($alpha_pt['pt_price']); ?></h2>
                    </div>

                    <?php
                endforeach;
            endforeach;
        ?>
    </div>
    <div class="row services">
        <?php
            $alpha_services = get_post_meta(get_the_ID(), '_services_');
            foreach($alpha_services as $alpha_service):
                foreach($alpha_service as $alpha_single_service):
                    ?>  
                    <div class="col-md-4">
                        <div class="service-item text-center">
                            <i class="<?php echo esc_attr($alpha_single_service['services_icon']); ?>"></i>
                            <h2><?php echo esc_html($alpha_single_service['services_title']); ?></h2>
                            <p><?php echo esc_html($alpha_single_service['services_description']); ?></p>
                        </div>
                    </div>
                    <?php
                endforeach;
            endforeach;
        ?>
    </div>
</div>

<?php
get_footer();