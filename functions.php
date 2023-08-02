<?php
function add_custom_nav_menu_class($classes, $item, $args)
{
    // Add your custom class 'Nav__item' to the classes array.
    $classes[] = 'Nav__item';

    return $classes;
}
add_filter('nav_menu_css_class', 'add_custom_nav_menu_class', 10, 3);
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Social Widget', 'laulo'),
        'description' => __('Area widger para o sidebar', 'laulo'),
        'id' => 'widget-social',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}
function custom_login_ajax_handler()
{
    check_ajax_referer('custom-login-nonce', 'security');

    $creds = array(
        'user_login'    => $_POST['username'],
        'user_password' => $_POST['password'],
        'remember'      => isset($_POST['rememberme']) ? $_POST['rememberme'] : false, // Set 'remember' based on the checkbox value
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        echo json_encode(array('success' => false, 'message' => 'Login failed. Please try again.'));
    } else {
        echo json_encode(array('success' => true, 'message' => 'Login successful.'));
    }

    die();
}
add_action('wp_ajax_custom_login', 'custom_login_ajax_handler');
add_action('wp_ajax_nopriv_custom_login', 'custom_login_ajax_handler');

function custom_login_localize_script()
{
    wp_localize_script(
        'custom-login-script', // Handle of your custom JavaScript file
        'custom_login_object',
        array('ajax_url' => admin_url('admin-ajax.php'))
    );
}
add_action('wp_enqueue_scripts', 'custom_login_localize_script');

// REST endpoints
require_once __DIR__ . '/inc/custom-rest-routes.php';

// FIXME: the parent theme consistently complains that the following is not
// defined, so let's define it here.
function create_post_type_html5() {}
