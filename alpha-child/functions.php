<?php

function alphachild_assets(){
    wp_enqueue_style('parent-style', get_parent_theme_file_uri().'/style.css');
}
add_action('wp_enqueue_scripts', 'alphachild_assets', 11);

function alphachild_main_style(){
    wp_dequeue_style('alpha');
    wp_dequeue_style('alpha-test');
    
    wp_deregister_style('alpha');
    wp_deregister_style('alpha-test');

    wp_enqueue_style('alpha-child-test', get_theme_file_uri('/assets/css/alpha.css'));
    wp_enqueue_style('alpha-child-main-style', get_theme_file_uri('style.css'));
}
add_action('wp_enqueue_scripts', 'alphachild_main_style', 12);

function alpha_body_class($classes){
    unset($classes[array_search('first-class', $classes)]);
    $classes[]= 'bayazid';
    return $classes;
}
add_filter('body_class', 'alpha_body_class');

function alpha_today(){
    return date('d-m-Y');
}