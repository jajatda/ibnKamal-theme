<?php
function ibnKamal_features(){
    // register_nav_menu('headerMenuLocation', 'Header Menu Location');
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

}

add_action('after_setup_theme', 'ibnKamal_features');

 //place your theme's functions.php
 /*
 * Set post views count using post meta
 */
function setPostViews($postID=null) {
    if(!is_single() || 'post' !== get_post_type() || current_user_can('administrator')) return;
    $postID = !empty($postID) ? $postID : get_the_ID();
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    update_post_meta($postID, $countKey, ((int)$count)+1);
}
add_action('template_redirect', 'setPostViews');