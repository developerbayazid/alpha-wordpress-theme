<?php

require_once get_theme_file_path('/inc/cmb2.php');
require_once get_theme_file_path('/inc/acf-mb.php');
require_once get_theme_file_path('/inc/tgm.php');

if ( class_exists( 'Attachments' ) ) {
    require_once "lib/attachments.php";
}

if ( site_url() == "http://127.0.0.1/hellodolly" ) {
    define( 'VERSION', time() );
} else {
    define( 'VERSION', wp_get_theme()->get( "Version" ) );
}

function alpha_bootstrapping() {
    load_theme_textdomain( "alpha" );

    add_theme_support( "post-thumbnails" );
    add_theme_support( "title-tag" );
    add_theme_support( 'html5', array( 'search-form' ) );
    add_theme_support( "custom-header", array(
        'header-text'        => true,
        'default-text-color' => '#222',
        'height'             => 600,
        'width'              => 1200,
        'flex-height'        => true,
        'flex-width'         => true,
    ) );
    add_theme_support( "custom-logo", array(
        'width'  => '100',
        'height' => '100',
    ) );
    add_theme_support( "custom-background", array(
        'default-image' => get_template_directory_uri() . '/assets/images/wavy-dots.png',
        'default-preset'         => 'custom',
        'default-attachment'     => 'fixed',
    ) );
    add_theme_support('post-formats', array('quote', 'audio', 'video', 'link', 'image'));

    register_nav_menu( "top_menu", __( "Top Menu", "alpha" ) );
    register_nav_menu( "footer_menu", __( "Footer Menu", "alpha" ) );

    add_image_size('alpha-square', 400, 400, true);
    add_image_size('alpha-portrait', 400, 9999);
    add_image_size('alpha-ladscape', 9999, 400);
    add_image_size('alpha-ladscape-hard', 600,400);

}
add_action( 'after_setup_theme', 'alpha_bootstrapping' );

function alpha_assets() {
    wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
    wp_enqueue_style( 'featherlight-css', '//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css' );
    wp_enqueue_style('dashicons');
    wp_enqueue_style('tiny-css', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css');
    wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('alpha-test', get_template_directory_uri().'/assets/css/alpha.css');
    
    wp_enqueue_style( 'alpha', get_stylesheet_uri());

    wp_enqueue_script( 'tiny-js', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js', array(), VERSION, true );
    wp_enqueue_script( 'featherlight-js', '//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js', array( 'jquery' ), VERSION, true );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'alpha_assets' );

function alpha_sidebar() {
    register_sidebar( array(
        'name'          => __( 'Single Post Sidebar', 'alpha' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Widgets in this area will be shown on all single posts', 'alpha' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Left', 'alpha' ),
        'id'            => 'footer-left',
        'description'   => __( 'Drag your left footer widget here', 'alpha' ),
        'before_widget' => '<p>',
        'after_widget'  => '</p>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer right', 'alpha' ),
        'id'            => 'footer-right',
        'description'   => __( 'Drag your right footer widget here', 'alpha' ),
        'before_widget' => '<p>',
        'after_widget'  => '</p>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'alpha_sidebar' );

function alpha_the_exerpt( $exerpt ) {
    if ( !post_password_required() ) {
        return $exerpt;
    } else {
        echo get_the_password_form();
    }
}
add_filter( 'the_excerpt', 'alpha_the_exerpt' );

function alpha_change_protected_title_format() {
    return "%s";
}
add_filter( 'protected_title_format', 'alpha_change_protected_title_format' );

function alpha_menu_css_class( $classes, $item ) {
    $classes[] = 'list-inline-item';
    return $classes;
}
add_filter( 'nav_menu_css_class', 'alpha_menu_css_class', 10, 2 );

function alpha_about_template_feature_image() {
    if ( is_page() ):
        $alpha_feature_image = get_the_post_thumbnail_url( null, 'large' );
    ?>
    <style>
        .page-header{
            background-image: url('<?php echo $alpha_feature_image ?>');
        }
    </style>
    <?php
        endif;

            if ( is_front_page() ) {
                if ( current_theme_supports( "custom-header" ) ) {
                ?>
    <style>
        .header{
            background-image: url(<?php echo header_image(); ?>);
            background-size: cover;
            margin-bottom: 40px;
        }
    </style>
    <?php
        }
            }
        ?>
<style>
    .header h3.tagline, .header h1 a{
        color: <?php echo '#' . get_header_textcolor(); ?>;

        <?php
            if ( !display_header_text() ) {
                    echo "display: none";
                }
            ?>
    }
</style>
<?php
}
add_action( 'wp_head', 'alpha_about_template_feature_image', 11 );

if(!function_exists('alpha_body_class')){
    function alpha_body_class($classes){
        unset($classes[array_search('first-class', $classes)]);
        $classes[]= 'bayazid';
        return $classes;
    }
}
add_filter('body_class', 'alpha_body_class');

function alpha_search_result_hightlights($text){
    if(is_search() && get_search_query() != ''){
        $pattern = '/('.join(' ', explode(' ', get_search_query())).')/i';
        $text = preg_replace($pattern, '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_title', 'alpha_search_result_hightlights');
add_filter('the_content', 'alpha_search_result_hightlights');
add_filter('the_excerpt', 'alpha_search_result_hightlights');

function alpha_image_srcset(){
    return null;
}
add_filter('wp_calculate_image_srcset', 'alpha_image_srcset');

if(!function_exists('alpha_today')){
    function alpha_today(){
        return date('d/m/Y');
    }
}

function alpha_modify_main_query($wpq){
    if(is_home() && $wpq->is_main_query()){
        $wpq->set('post__not_in', array(652));
        // $wpq->set('category__not_in', array(1));
    }
}
add_action('pre_get_posts', 'alpha_modify_main_query');

add_filter('acf/settings/show_admin', '__return_false');


function alpha_admin_assets( $hook ) {
    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $post_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }
    if ( "post.php" == $hook ) {
        $post_format = get_post_format($post_id);
        wp_enqueue_script( "admin-js", get_theme_file_uri( "/assets/js/admin.js" ), array( "jquery" ), VERSION, true );
        wp_localize_script("admin-js","alpha_pf",array("format"=>$post_format));
    }
}

add_action( "admin_enqueue_scripts", "alpha_admin_assets" );