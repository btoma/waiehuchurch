<?php

function modify_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-1.11.3.min.js');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'modify_jquery');

/*----------------auto-year----------------*/
/**
 * Auto Update the year with short-code.
 * @return false|string
 *
 */
function bt_date(){
    return date('Y');
}
add_shortcode('year','bt_date');

/*-----------------add class to enfold---------------*/
/**
 * added class section enfold avi builder..
 */
add_theme_support('avia_template_builder_custom_css');

/*------------------add class with page name--------------------*/

/**
 * checking if is sub-page return class name.
 * @return string
 */
function bt_sub_page(){
  global $wp_query;
    $page ='';

    if(is_front_page()){
        $page = 'home';
    }elseif (is_page()){
        $page = "sub-page";
    }
    return $page;
}

/**
 * return page name for header class.
 * @return string
 */
function bt_page_class(){
    global $wp_query;
    $page ='';

    if(is_front_page()){
        $page = 'home';
    }elseif (is_page()){
        $page = "page_name_". $wp_query->query_vars["pagename"];
    }
    return $page;
}

/**
 *  add parent class to child page
 * @param $classes
 * @return array
 */
function bt_body_class( $classes ) {
    global $post;
    if ( is_page() ) {
        // Has parent / is sub-page
        if ( $post->post_parent ) {
            # Parent post name/slug
            $parent = get_post( $post->post_parent );
            $classes[] = 'parent-slug-'.$parent->post_name;
            // Parent template name
            $parent_template = get_post_meta( $parent->ID, '_wp_page_template', true);
            if ( !empty($parent_template) )
                $classes[] = 'parent-template-'.sanitize_html_class( str_replace( '.', '-', $parent_template ) );
        }
    }
    return $classes;
}
add_filter( 'body_class', 'bt_body_class' );

/*-------------------------breadcrumb------------------------*/
include_once(dirname(__FILE__) . "/avia_breadcrumb_shortcode.php");
/**
 * added shortcode for breadcrumb..
 * @param $args
 * @return string
 */
function our_breadcrumbs_shortcode($args)
{
    $breadcrumbs = new avia_breadcrumb_shortcode();
    return $breadcrumbs->avia_breadcrumb();
}

add_shortcode('bread_crumb', 'our_breadcrumbs_shortcode');

/*------------------------include script--------------------------*/
/**
 * include script to wordpress.
 */
function custom_scripts(){
    wp_enqueue_script('sidebar', get_stylesheet_directory_uri().'/js/sidebar-moving.js', array(), false, true);
}
add_action('wp_enqueue_scripts','custom_scripts');

/*-------------------------------------------------------------------*/