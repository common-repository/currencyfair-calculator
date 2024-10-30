<?php
/**
 * Plugin Name: CurrencyFair Calculator
 * Plugin URI: https://wordpress.org/plugins/currencyfair-calculator
 * Description: Add CurrencyFair calculator on your website
 * Version: 1.0.1
 * Author: CurrencyFair
 * Author URI: http://currencyfair.com
 */
if (!defined('ABSPATH') || defined('CF_WP_VERSION')) {
    return;
}

define('CURRENCYFAIR_ROOT_PATH', plugin_dir_path(__FILE__));

require dirname(__FILE__) . '/inc/cf_constants.php';
require dirname(__FILE__) . '/inc/cf_apiClient.php';
require dirname(__FILE__) . '/inc/cf_calculator_functions.php';
register_uninstall_hook(__FILE__, 'uninstall_currencyfair_plugin');

/**
 * ACTIONS & FILTERS
 */
add_action('admin_menu', 'register_currencyfair_main_menu');
add_action('admin_init', 'register_currencyfair_settings');
add_action('wp_ajax_currencyfair_validate_secret_key', 'currencyfair_validate_secret_key');
add_filter('plugin_action_links', 'register_currencyfair_action_links', 10, 2);


function currencyfair_validate_secret_key()
{
    $secret_key = $_REQUEST['secret_key'];
    $response = new WP_Ajax_Response;

    $cfApi = new CurrencyFair\ApiClient();
    $access_token = $cfApi->getAccessToken($secret_key);
    if ($access_token) {
        $response->add(array(
            'data'  => 'updated',
            'supplemental' => array(
                'access_token' => $access_token,
                'message' => cf_get_msg('notice_access_token_saved')
            )
        ));
    } else {
        $response->add(array(
            'data'  => 'error',
            'supplemental' => array(
                'access_token' => $access_token,
                'message' => cf_get_msg('notice_access_token_invalid')
            )
        ));
    }

    $response->send();
    exit();
}

function register_currencyfair_main_menu()
{
    // Main Button - points to the settings page by default
    add_menu_page(
        'CurrencyFair',
        'CurrencyFair',
        'manage_options',
        'currencyfair-main',
        ''
    );

    // Add style for the CurrencyFair logo menu page button icon
    wp_enqueue_style(
        'cf_logo',
        plugins_url('/public/css/currencyfair_logo.css', __FILE__),
        false,
        CF_WP_VERSION
    );

    // Submenu buttons, overwrite the Main action with the Settings button
    add_submenu_page(
        'currencyfair-main',
        cf_get_msg('button_submenu_settings'),
        cf_get_msg('button_submenu_settings'),
        'manage_options',
        'currencyfair-main',
        'currencyfair_settings_page'
    );
}

function currencyfair_settings_page()
{
    $secret_key = esc_attr(get_option('currencyfair_account_secret_key'));

    wp_enqueue_script(
        'save_secret_key_script',
        plugins_url('/public/js/cf_validate_secret_key.js', __FILE__),
        false,
        CF_WP_VERSION,
        true
    );
    wp_localize_script('save_secret_key_script', 'param', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'genericErrorMsg' => cf_get_msg('notice_generic_error_message')
    ));

    wp_enqueue_style(
        'header_style',
        plugins_url('/public/css/header.css', __FILE__),
        false,
        CF_WP_VERSION
    );

    wp_enqueue_style(
        'save_secret_key_style',
        plugins_url('/public/css/validate_secret_key.css', __FILE__),
        false,
        CF_WP_VERSION
    );

    ob_start();
    require_once(CF_VIEW_DIR . 'header.php');
    require_once(CF_VIEW_DIR . 'settings.php');
    echo ob_get_clean();
}

// register settings
function register_currencyfair_settings()
{
    register_setting('currencyfair-settings-group', 'currencyfair_account_secret_key');
}

// show widget pages only if secret key is set
if (get_option('currencyfair_account_secret_key')) {
    // include the calculator widget
    require CF_RES_DIR . 'calculator.php';
}

// Provide a Shortcut to Your Settings Page with Plugin Action Links
function register_currencyfair_action_links($links, $file)
{
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=currencyfair-main">' . cf_get_msg('button_submenu_settings') . '</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}

function uninstall_currencyfair_plugin()
{
    delete_option('currencyfair_account_secret_key');
}
